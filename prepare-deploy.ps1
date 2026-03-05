# ============================================
# Blue Draft - Prepare for Manual Hostinger Deployment
# ============================================
# Run: .\prepare-deploy.ps1
# Creates: deploy/blue_draft_pro/ folder and blue_draft_pro_deploy.zip

$ErrorActionPreference = "Stop"
$ProjectRoot = $PSScriptRoot
$DeployDir = Join-Path $ProjectRoot "deploy"
$PackageDir = Join-Path $DeployDir "blue_draft_pro"
$ZipFile = Join-Path $DeployDir "blue_draft_pro_deploy.zip"

Write-Host ""
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  Blue Draft - Prepare for Hostinger" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

# 1. Build assets
Write-Host "[1/4] Building assets (npm run build)..." -ForegroundColor Yellow
Set-Location $ProjectRoot
npm run build 2>&1 | Out-Null
if ($LASTEXITCODE -ne 0) {
    Write-Host "ERROR: npm run build failed" -ForegroundColor Red
    exit 1
}
Write-Host "      Assets built successfully" -ForegroundColor Green

# 2. Clean deploy folder
Write-Host "[2/4] Preparing deploy folder..." -ForegroundColor Yellow
if (Test-Path $DeployDir) {
    Remove-Item $DeployDir -Recurse -Force
}
New-Item -ItemType Directory -Path $PackageDir -Force | Out-Null

# 3. Copy files (exclude vendor, node_modules, .git, .env, etc.)
Write-Host "[3/4] Copying project files..." -ForegroundColor Yellow

$ExcludeDirs = @("vendor", "node_modules", ".git", "deploy", ".idea", ".vscode", ".fleet", ".nova")
$ExcludeFiles = @(".env", ".env.backup", ".env.production", "*.log", ".phpunit.result.cache", "Thumbs.db", ".DS_Store")

# Use robocopy for reliable copy with exclusions
$RoboArgs = @(
    $ProjectRoot,
    $PackageDir,
    "/E",           # Copy subdirs including empty
    "/XD", "vendor", "node_modules", ".git", "deploy", ".idea", ".vscode", ".fleet", ".nova", "storage\framework\views", "storage\framework\cache", "storage\framework\sessions", "storage\logs",
    "/XF", ".env", ".env.backup", ".env.production", "*.log", ".phpunit.result.cache", "Thumbs.db", ".DS_Store", "Homestead.json", "Homestead.yaml", "auth.json",
    "/NFL", "/NDL", "/NJH", "/NJS", "/NC", "/NS", "/NP"  # Minimal output
)
$result = robocopy @RoboArgs
# Robocopy exit codes: 0-7 = success, 8+ = errors
if ($result -ge 8) {
    Write-Host "ERROR: robocopy failed with code $result" -ForegroundColor Red
    exit 1
}

# Copy .env.hostinger.example as template (user renames to .env on server)
Copy-Item (Join-Path $ProjectRoot ".env.hostinger.example") (Join-Path $PackageDir ".env.hostinger.example")

# Create empty storage dirs if missing (for structure)
$StorageDirs = @(
    "storage\app\public",
    "storage\app\public\images",
    "storage\app\public\images\projects",
    "storage\app\public\images\hero",
    "storage\app\public\images\about",
    "storage\app\public\images\testimonials",
    "storage\app\public\images\quotes",
    "storage\framework\cache\data",
    "storage\framework\sessions",
    "storage\framework\views",
    "storage\logs",
    "bootstrap\cache"
)
foreach ($dir in $StorageDirs) {
    $fullPath = Join-Path $PackageDir $dir
    if (-not (Test-Path $fullPath)) {
        New-Item -ItemType Directory -Path $fullPath -Force | Out-Null
    }
}

# Add .gitkeep to empty dirs so they get created
@("storage\framework\cache\data", "storage\framework\sessions", "storage\framework\views", "storage\logs", "bootstrap\cache") | ForEach-Object {
    $gitkeep = Join-Path $PackageDir "$_\.gitkeep"
    $parent = Split-Path $gitkeep -Parent
    if (Test-Path $parent) {
        "" | Out-File $gitkeep -Encoding utf8
    }
}

Write-Host "      Files copied successfully" -ForegroundColor Green

# 4. Create ZIP
Write-Host "[4/4] Creating ZIP archive..." -ForegroundColor Yellow
if (Test-Path $ZipFile) {
    Remove-Item $ZipFile -Force
}
Compress-Archive -Path $PackageDir -DestinationPath $ZipFile -CompressionLevel Optimal

$ZipSize = [math]::Round((Get-Item $ZipFile).Length / 1MB, 2)
Write-Host "      ZIP created: $ZipSize MB" -ForegroundColor Green

Write-Host ""
Write-Host "========================================" -ForegroundColor Green
Write-Host "  Deployment package ready!" -ForegroundColor Green
Write-Host "========================================" -ForegroundColor Green
Write-Host ""
Write-Host "  Folder: $PackageDir" -ForegroundColor White
Write-Host "  ZIP:    $ZipFile" -ForegroundColor White
Write-Host ""
Write-Host "Next steps:" -ForegroundColor Yellow
Write-Host "  1. Upload the ZIP to Hostinger (FTP or File Manager)"
Write-Host "  2. Extract in public_html (or domains/tudominio.com/public_html)"
Write-Host "  3. Rename .env.hostinger.example to .env and configure"
Write-Host "  4. Run: composer install --optimize-autoloader --no-dev"
Write-Host "  5. Run: php artisan key:generate"
Write-Host "  6. Run: php artisan migrate --force && php artisan db:seed --force"
Write-Host "  7. Run: php artisan storage:link"
Write-Host "  8. Set Document Root to public/"
Write-Host ""
Write-Host "Full guide: docs/HOSTINGER_MANUAL_DEPLOY.md" -ForegroundColor Cyan
Write-Host ""

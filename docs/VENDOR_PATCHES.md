# Parches aplicados a vendor

Este proyecto aplica parches manuales a paquetes de vendor para resolver incompatibilidades.

## 1. filament/support — is_slot_empty

**Archivo:** `vendor/filament/support/src/helpers.php`  
**Problema:** `is_slot_empty()` espera `?Htmlable` pero Blade puede pasar un array cuando el modal tiene múltiples elementos raíz.  
**Error:** `TypeError: Argument #1 ($slot) must be of type ?Htmlable, array given`

**Solución aplicada:** Se modificó la función para aceptar `mixed` y manejar arrays.

---

## 2. filament/support — modal slots como array

**Archivo:** `vendor/filament/support/resources/views/components/modal/index.blade.php`  
**Problema:** Al renderizar `{{ $slot }}`, `{{ $footer }}` o `{{ $header }}`, si son arrays se pasa a `htmlspecialchars()` que espera string.  
**Error:** `TypeError: htmlspecialchars(): Argument #1 ($string) must be of type string, array given`

**Solución aplicada:** Se envuelve cada renderizado de slot en un `@if (is_array(...))` que itera con `@foreach` en lugar de imprimir directamente.

---

**Después de `composer update`:** Si actualizas `filament/support`, estos parches se perderán. Vuelve a aplicarlos manualmente.

@echo off
cd /d "%~dp0"
echo Building Tailwind CSS...
call npm run build
if %errorlevel% equ 0 (
    echo.
    echo ✓ Build complete! The admin dashboard should now have colors and styles.
    echo.
    echo Next steps:
    echo 1. Run: php artisan serve
    echo 2. Visit: http://localhost:8000/admin
) else (
    echo.
    echo ✗ Build failed. Please check the error above.
)
pause

@echo off
:: Nastavení cest
SET RCLONE_PATH=C:\rclone-v1.69.1-windows-amd64\rclone.exe
SET LOCAL_PATH=C:\Users\honzi\Desktop\MP-zachito-15c83000cd92d851a89b701dbc6c69f9ea83d820
SET REMOTE_PATH=mp:/web


:: Spuštění rclone copy
%RCLONE_PATH% sync %LOCAL_PATH% %REMOTE_PATH%  --log-level=INFO 

:: Kontrola, zda synchronizace proběhla úspěšně
if %ERRORLEVEL% neq 0 (
    echo Synchronizace selhala. 
    pause
) else (
    echo Synchronizace proběhla uspesne.
)

:: Konec
exit
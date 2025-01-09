@echo off
REM Cambiar al directorio del proyecto
cd /d "C:\xampp\htdocs"

REM Añadir todos los archivos al área de preparación
git add .

REM Solicitar el mensaje del commit
set /p commit_message=Introduce el mensaje del commit: 

REM Realizar el commit con el mensaje proporcionado
git commit -m "%commit_message%"

REM Subir los cambios al repositorio remoto
git push origin master

pause

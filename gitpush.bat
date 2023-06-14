@echo off
set "remote=origin"
set "branch=main"
set "message=Push some changes"
set /p "remote=Enter Remote Name [default: %remote%] : "
set /p "branch=Enter Branch Name [default: %branch%] : "
set /p "message=Enter Commit Massage : "

git add .
git commit -m %message%
git push -u %remote% %branch%

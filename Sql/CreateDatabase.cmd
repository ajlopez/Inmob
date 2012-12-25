"\xampp\mysql\bin\mysqladmin.exe" --user=root --force --password= drop inmob
"\xampp\mysql\bin\mysqladmin.exe" --user=root --password= create inmob
"\xampp\mysql\bin\mysql" --user=root --password= inmob  < %~dp0Database.sql

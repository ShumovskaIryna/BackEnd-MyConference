# Test assignment
Действия для выполнения
1. git clone <repo>
2. Change db config (/config/db)
3. Run db migration and seed 
```bash
mysql -u <user_name> -p <db_name> < dbseed.sql
```
4. Start server
```bash
cd public && php -S localhost:8000
```


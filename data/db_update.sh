docker exec -i dtvbmartru_php_1 php artisan down
cat ./data/db/dt_db.sql | docker exec -i dtvbmartru_mysql_1  /usr/bin/mysql -u dt_user --password=password dt_db
docker exec -i dtvbmartru_php_1 php artisan up
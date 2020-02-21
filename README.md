
## API Skeleton Project  
  
1. Install Dependencies  
  
	`composer install`  
  
2. Create 'app' Database  
  
	`CREATE DATABASE app CHARACTER SET utf8 COLLATE utf8_general_ci;`
	
3. Run Migrations  
  
	`vendor/bin/electra migrate:all`  

3. Add To /etc/hosts

    `127.0.0.1 api.skeleton.local www.skeleton.local`  
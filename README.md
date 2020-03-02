0. Fire up Apache server
1. Run sql/db.sql
2. Fill config/db.ini with your credentials. Sample -> config/db.ini.sample
3. Default admin Email: admin@library.com | Default admin password: admin

because spl_autoload_register is extremely old, it works correctly under Windows. An external autoloader class is required to work correctly under a Linux environment

All data is only for logged users
There have Admin/user roles

User can:
	- View book
	- Add/remove book on his/her collection
	- Change profile data
	
Admin can:
	- View/Create/Edit/Remove book
	- Add/remove book on his/her collection
	- Activate/Deactivate registered users
	- Change profile data
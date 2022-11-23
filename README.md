# rabitmq-curling
Title:

It's fetching data from news website and do parallel processing by using MQ and put data into database'

Description:

I'm using folloing files in this whole code.

db.php: It's a file which contain logics related to getting,saving and updateing data into database news table
senidng.php: It's a file which contain logics to getting data from https://highload.today website and put data in RabitMQ to sending data parallel way.
rececing: It's a file which contain getting data from sending point of MQ and put into database.



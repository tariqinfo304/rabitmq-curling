# rabitmq-curling
This code implementation involves fetching data from a news website and performing parallel processing using message queues (MQ) to store the data into a database.

## Files Used:

db.php: This file contains the necessary logic for retrieving, saving, and updating data in the news table of the database.
sending.php: This file handles the logic for fetching data from the https://highload.today website and putting it into a RabbitMQ to enable parallel data transmission.
receiving.php: This file focuses on retrieving data from the sending point of the message queue (MQ) and storing it into the database for further processing and analysis.
These files collectively enable the parallel processing of data, allowing for efficient retrieval, storage, and utilization of news data from the specified website.



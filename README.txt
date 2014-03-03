 ______                  _             
(_____ \                | |            
 _____) )_____ _____  __| |____  _____ 
|  __  /| ___ (____ |/ _  |    \| ___ |
| |  \ \| ____/ ___ ( (_| | | | | ____| (Readme)
|_|   |_|_____)_____|\____|_|_|_|_____)


The goal of this wrapper is to help you get started with the VR API. The wrapper provides insights into connecting and making VR API calls. You can extend this and create your own custom application. The wrapper does not cover all the API calls VR provides. For a full list of API calls VR provides, please refer to the documentation. This software is provided "as-is", please note that VerticalResponse will not maintain or update this.

    ______           __                      
   / ____/__  ____ _/ /___  __________  _____
  / /_  / _ \/ __ `/ __/ / / / ___/ _ \/ ___/
 / __/ /  __/ /_/ / /_/ /_/ / /  /  __(__  )   (Features)
/_/    \___/\__,_/\__/\__,_/_/   \___/____/  
                                             

This wrapper allows you to:

1. Make Contact-related operations:
   - Create a contact
   - Get a list of all your contacts
   - Get the details of a particular contact

2. Make List-related operations
   - Create a list
   - Get all of your lists
   - Get the details of a particular list
   - Create a contact in a particular list

3. Make HTTP calls to the API
   - Make a direct GET request to the API
   - Make a direct POST request to the API

   ______            _____                        __  _           
  / ____/___  ____  / __(_)___ ___  ___________ _/ /_(_)___  ____ 
 / /   / __ \/ __ \/ /_/ / __ `/ / / / ___/ __ `/ __/ / __ \/ __ \
/ /___/ /_/ / / / / __/ / /_/ / /_/ / /  / /_/ / /_/ / /_/ / / / /  (Configuration)
\____/\____/_/ /_/_/ /_/\__, /\__,_/_/   \__,_/\__/_/\____/_/ /_/ 
                       /____/                                     


In order to use the methods in this wrapper, you'll need to set your credentials.
To do so, you'll need to add the following lines of code. (Replace YOUR_CLIENT_ID and YOUR_ACCESS_TOKEN with your proper credentials)

  putenv('VR_API_CLIENT_ID=YOUR_CLIENT_ID');
  putenv('VR_API_ACCESS_TOKEN=YOUR_ACCESS_TOKEN');

After that, you are free to use all of the methods of this wrapper.

    ______                           __         
   / ____/  ______ _____ ___  ____  / /__  _____
  / __/ | |/_/ __ `/ __ `__ \/ __ \/ / _ \/ ___/
 / /____>  </ /_/ / / / / / / /_/ / /  __(__  )   (Examples)
/_____/_/|_|\__,_/_/ /_/ /_/ .___/_/\___/____/  
                          /_/                   


An examples folder has been provided in order to give you guidance about how to use this wrapper. In this folder you will find the following files:

  - contacts.php: Provides examples on how to perform contact-related operations. You will find the examples listed below.
                  > HOW TO: Make direct requests to the API
                    - Example #1: Make a POST request to create a contact
                    - Example #2: Make a GET request to get all of your contacts
                  > HOW TO: Make object oriented requests to the API
                    - Example #3: Make an object oriented request to get all of your contacts
                    - Example #4: Get the details from your first contact in your contact list (object-oriented)
                    - Example #5: Make an object oriented request to get your contact list with pagination
                    - Example #6: Make an object oriented request to create a contact

  - lists.php:    Provides examples on how to perform list-related operations. You will find the examples listed below.
                  > HOW TO: Make direct requests to the API
                    - Example #1: Make a POST request to create a new list
                    - Example #2: Make a GET request to get your lists
                  > HOW TO: Make object oriented requests to the API
                    - Example #3: Make an object oriented request to create a new list
                    - Example #4: Make an object oriented request to get all of your lists
                    - Example #5: Make an object oriented request to get all of your lists with pagination
                    - Example #6: Get the details from your first list (object-oriented)
                    - Example #7: Make an object oriented request to get all the contacts that belong to a particular list
                    - Example #8: Make an object oriented request to create a contact in a particular list

  - errors.php:   Provides examples on how to handle errors related to this wrapper. You will find the examples listed below.
                  > HOW TO: Handle possible exceptions that might occur while using this wrapper
                    - Example #1: Handle a request made with invalid parameters
                    - Example #2: Handle a request made with invalid credentials

We also added an examples folder. This folder has a Test class and a test.php script. The test class is a simplified version of all the methods supported in this wrapper, and the test.php script contains an example of how to use the Test class.

Remember to set your credentials in all of the script files of the examples and test folders. Otherwise, you won't be able to run the scripts and see the responses.

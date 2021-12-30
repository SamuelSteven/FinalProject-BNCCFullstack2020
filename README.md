# Final Project Webmaster Fullstack

## Project Description
This is a **final project from Webmaster Fullstack Class** from student organization BNCC BINUS@Bandung. This project is a requirement to get a project completion certificate. The task of this project is to create a **General Discussion Forum Website**. The work on the final project is allowed individually or in a team of a maximum of 2 people. But I chose to work with my friend because I wanted to train and familiarize myself with pair programming techniques. This project is a Fullstack project, therefore the participants are working on both the frontend and the backend as well as possible.

## Project Requirements
One of the requirements that must be met is that we must use **Laravel 7** with built-in blade templating system, eloquent ORM, relationship (in model), migration, and scaffold auth. In addition, we are required to look for references and try to make it look similar to the original reference so that it is better but if we want to make a different look it is also allowed. We choose Sunib Curhat (https://sunibcurhat.com/) as a reference for our forum website because we agree that the Sunib Curhat forum has an elegant, colorful, and attractive appearance if it is used as a question and answer forum.

There are also some minimal features that must be on the forum:
- Home: the public can see the list of existing threads.
- Register and Login (please use the auth scaffold from Laravel)
- Edit Account: change password, name, or other information
- View My Profile and other people's profiles
- View the Thread along with the reply
- Can reply to threads/forums if already logged in
- Can reply to reply at least 1 level
- Can delete and edit your own reply
- Can delete and edit threads (posts) that started on their own
- Can close the thread (so it can't be replied, but not deleted)

## Project Document
Before we do the coding, we make an **Entity Relationship Diagram** and **Use Case Diagram** to represent the flow of relationships between entities so that it makes it easier for us to design databases and linkages between models in laravel.

![ERD](https://user-images.githubusercontent.com/65062685/147770361-cc8024a1-1055-45cc-9a30-1d91bae62b48.png)

**Use Case Diagram**

![use-case-diagram](https://user-images.githubusercontent.com/65062685/147770885-071784be-fe0c-47ca-a573-181a10887af1.png)

## Project Result
The program is in accordance with the requirements given and the program runs well without any bugs or errors. When the program is run, the program will display results as shown in the following image:

![Forum-Sunib-Register](https://user-images.githubusercontent.com/65062685/147770530-b73e3ea1-b3ac-4ae6-8e42-17dcec099069.png)
![Forum-Sunib-Login](https://user-images.githubusercontent.com/65062685/147770597-0dbeed1d-ed83-4349-9193-efa2f2f460a4.png)
![Forum-Sunib-Settings-Password](https://user-images.githubusercontent.com/65062685/147770691-0da42685-732b-4694-be05-f53738c02a63.png)
![Forum-Sunib-Settings-Photo](https://user-images.githubusercontent.com/65062685/147770702-6f8aa268-d46f-45cc-ab6f-162c44cab6f8.png)
![Forum-Sunib-Settings-Profile](https://user-images.githubusercontent.com/65062685/147770708-7032e312-39f9-4ff3-b656-9c305e51c48e.png)
![Forum-Sunib-Thread](https://user-images.githubusercontent.com/65062685/147770662-c2d6ef92-9429-4b7d-b4ee-cadb1abe2d91.png)
![Forum-Sunib-Question](https://user-images.githubusercontent.com/65062685/147770460-ff5bb78a-8e03-44be-a018-fe12cb32fa00.png)

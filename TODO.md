# LAMA
### TODO list

* **general**
    - [ ] e.g. when an user is not logged in and tries to create a post we display 403 page. SHoyld we redirect user to login/register form and then redirect him back to post creation
    - [ ] in the same situation, when we try to rate a content ou comment something nothing is done 
    - [ ] transaction
    - [ ] print css
    - [ ] verify forms input with js
    - [ ] internal db error architecture
    - [ ] helper
    - [ ] html and css errors

* **user profile**
    - [x] only the owner can edit the profile (policies)
    - [x] display remaining time to unblock
    - [x] countdown if user is blocked
    - [x] condition to display if user is block is not correct
    - [ ] how do we handle the countdown reaches 0?
    - [X] only show countdown (in case user is blocked) if the user blocked is the one authenticated

* **edit profile**
    - [x] only allow .jpg and .png files in the photo form
    - [x] when the user submits the "change photo" without any files nothing should happen (at this moment it gives an error)
    - [x] cut photos to make them all the same size
    - [x] error/success messages in photo edition
    - [x] crop photo
    - [x] error/success messages
    - [x] css is kind weird after error messages, fix it
    - [x] delete photo with bug in ajax request
    - [ ] not working in production (change photo)
    
* **post creation**
    - [x] if the user is not an admin, "community news" should not appear as an option at categories
* **post preview**
    - [ ] newlines/format text
* **post deletion**
    - [ ] form to confirm action
* **post controller**
    - [x] the rating functions should be on the content controller
* **comment controller**
    - [x] the rating functions should be on the content controller

* **home page**
    - [x] when we are in small screens(i.e. cellphones) the bar indicating fresh,hot or top is not updating the posts.
    - [ ] rating and staring posts is not working when we order posts (event listeners probably not working)
* **categories page**
    - [ ] it is necessary to review categories page, at this moment you can only give star / unstar in order by name
    - [ ] when we create a post ORDER BY ACTIVITY is not working 
* **comments**
    - [ ] post's owner should have green link
    - [ ] link in user name to redirect to profile



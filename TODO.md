# LAMA
### TODO list

* **user profile**
    - [ ] only the owner can edit the profile (policies)
    - [ ] change directory @profile dropdown

    - [x] display remaining time to unblock
    - [x] countdown if user is blocked
    - [ ] condition to display if user is block is not correct
    - [ ] how do we handle the countdown reaches 0?


* **edit profile**
    - [x] only allow .jpg and .png files in the photo form
    - [x] when the user submits the "change photo" without any files nothing should happen (at this moment it gives an error)
    - [x] cut photos to make them all the same size
    - [x] error/success messages in photo edition
    - [x] crop photo
    - [x] error/success messages
    - [x] css is kind weird after error messages, fix it
    - [x] delete photo with bug in ajax request
    
* **post creation**
    - [ ] if the user is not an admin, "community news" should not appear as an option at categories
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

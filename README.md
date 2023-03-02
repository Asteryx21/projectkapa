# Project ΚαΠα web application
### !!! Work in progress !!! 
Project ΚαΠα is an environmental volunteer team based on Patras, Greece that does clean-ups in polluted areas.
<br>
<br>
The purpose of this web application is to inform the people about our team and our causes but also to inspire them to join us.
<br>
<br>
The user can register (using email verification OTP [PHPMailer](https://github.com/PHPMailer/PHPMailer)) and then login to our platform and:
<br>
* **In the About section** there are information about our team such as who we are, what we do, awards we earned and collaborations we had.
* **In the Calendar section** there is a calendar ([fullcalendar.js library](https://fullcalendar.io/)) where the events are posted. 
Users can click on some event in the calendar and on the modal that appears they can declare if they are interested to participate.
* **In the Services section** there is a map ([Leaflet JS](https://leafletjs.com/)) where they can have 3 options:
  * See the areas where the team have done clean-ups (Green markers).
  * Report a poluted area.
  * See the areas where users have reported (Red markers).
* **In the Education section** there is quiz regarding 3Rs (Reduce, Reuse & Recycle) mentality.
* **In the Profile section** they can see the events they declared interested and a graph ([Chart JS](https://www.chartjs.org/)) with all the users and their participation rates.


Made with: JavaScript, JQuery, CSS, SCSS, PHP, MySQL

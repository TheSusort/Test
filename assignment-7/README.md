Assignment 7
============

Your task is to create a simple "MyTunes" web application that allows users to browse music albums. When clicking on an album, the followings need to be displayed (using Ajax, that is, without reloading the entire webpage):

  * the album cover
  * the track list (track number, title, length)
  * the total album length

You are provided with a sample page and a style sheet file. 
Your task is to 

  1. Adjust the `index.html` file as needed. 
    * You are welcome to customize the appearance and style to your liking as long as all album and track details are displayed.
  2. Write JavaScript code that makes an asynchronous http request, then receives the response and updates the album info part of the page. 
    * This part need to be done in pure JavaScript using XMLHttpRequest (i.e., using jQuery is not allowed).
  3. Write a server-side PHP script that generates responses to the JavaScript requests.
    * Advanced students may use Smarty, but it is not mandatory.
  4. Supply your application with sample data.
    * Include at least 3 albums
      * For each album: artist, title, cover image, and at least 10 songs
      * For each song: track number, title, and length
    * You can use MySQL to store this data, but it’s not mandatory. You may also just store them in arrays inside the PHP file(s).


Delivery
--------

  1. Push your solution to github
  2. Deploy it on the unix servers so that it is available at <http://www.ux.uis.no/~yourusername/dat310-mytunes>
  3. Submit your unix username on itslearning

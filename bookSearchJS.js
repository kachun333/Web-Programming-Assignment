$(document).ready(function(){

  $("#searchBookForm").submit(function(event){
       event.preventDefault();
      var search = $("#searchISBN").val();

      if (search == '') {
        alert("Please enter an ISBN");
      }else{
        var url = '';
        var img = '';
        var title = '';
        var author = '';
        var description = '';
        //var genre = ''; //No Genre in Google Books API
        var edition = '';
        var isbn_13 = '';
        var year = '';
        var publisher = '';
        var pages = '';

        $.get("https://www.googleapis.com/books/v1/volumes?q="+search, function(response){

            if ((response.items[0].volumeInfo.title) != undefined) {
              title = response.items[0].volumeInfo.title;
            }
            if ((response.items[0].volumeInfo.subtitle) != undefined) {
              title = title + ": " + response.items[0].volumeInfo.subtitle;
            }
            if ((response.items[0].volumeInfo.authors) != undefined) {
              author = response.items[0].volumeInfo.authors;
            }
            if ((response.items[0].volumeInfo.imageLinks.thumbnail) != undefined) {
              image = response.items[0].volumeInfo.imageLinks.thumbnail;
            }
            if ((response.items[0].volumeInfo.infoLink) != undefined) {
              url = response.items[0].volumeInfo.infoLink;
            }
            if ((response.items[0].volumeInfo.description) != undefined) {
              description = response.items[0].volumeInfo.description;
            }
            if ((response.items[0].volumeInfo.industryIdentifiers[0].identifier) != undefined) {
              isbn_13 = response.items[0].volumeInfo.industryIdentifiers[0].identifier;
            }
            if ((response.items[0].volumeInfo.publishedDate) != undefined) {
              year = response.items[0].volumeInfo.publishedDate;
            }
            if ((response.items[0].volumeInfo.publisher) != undefined) {
              publisher = response.items[0].volumeInfo.publisher;
            }
            if ((response.items[0].volumeInfo.pageCount) != undefined) {
              pages = response.items[0].volumeInfo.pageCount;
            }
             window.location.href = "bookinfo.php?title=" + title + "&author=" + author
             + "&url=" + url + "&description=" + description + "&ISBN=" +isbn_13+ "&year="+year
             + "&publisher="+publisher+"&pages="+pages+"&image="+image;

        });
      }
  });

  return false;
});

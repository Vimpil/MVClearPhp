
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable");
  switching = true;
  // Set the sorting direction to ascending:
  dir = "asc";
  console.log('dfasdfasdf');
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /* Check if the two rows should switch place,
      based on the direction, asc or desc: */
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      // Each time a switch is done, increase this count by 1:
      switchcount ++;
    } else {
      /* If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again. */
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}





/* PAGINATION OF TABLE  */

 // $(document).ready(function(){
 //    load_data();  
 //      function load_data(page)  
 //      {  
 //           $.ajax({  
 //                url:"pagination.php",  
 //                method:"POST",  
 //                data:{page:page},  
 //                success:function(data){  
 //                     $('#pagination_data').html(data);  
 //                },
 //                error:function(){
 //                  alert('error');
 //                }
 //           })  
 //      }  
 //      $(document).on('click', '.pagination_link', function(){  
 //           var page = $(this).attr("id");  
 //           load_data(page);  
 //      });  
 // });  


 $(document).ready(function(){

  console.log('here');

 $(document).on("click","body",function() {
        


  var something = 'HEHE )';
  $.ajax({

      type: "GET",
    contentType: "json; charset=utf-8",

     url:'/controllers/IndexController.php/responces',
     
     success: function(response){       
        console.log('Sucess');
        console.log(response);

     },
     error: function(){
        console.log('error');
     }
   });

      });


 
   $('#sel_user').change(function(){

    var username = $(this).val();
    $.ajax({
     url:'index.php/User/userDetails',
     method: 'post',
     data: {username: username},
     dataType: 'json',
     success: function(response){
       var len = response.length;
       $('#suname,#sname,#semail').text('');
       if(len > 0){
         // Read values
         var uname = response[0].username;
         var name = response[0].name;
         var email = response[0].email;
 
         $('#suname').text(uname);
         $('#sname').text(name);
         $('#semail').text(email);
 
       }
 
     }
   });

  });
 });
   
/* END PAGINATION OF TABLE  */
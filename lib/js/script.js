
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

$(document).ready(function(){

  var action = 'updateRowTask';
    $id='';
    $task='';    
    load_data();
    console.log('heehe');

    function load_data(page)
    {
      
         $.ajax({
              type:"POST",                
              data: {
                action:action, page:page
              },                
              dataType: "html",
              async: false,
              success:function(response){
                console.log('success');
                console.log(page);
                console.log(response);
                   $('#pagination_data').html(response);                                            
              },
              error:function(){
                alert('error');
              }
         })
    }


  




  var action = 'changeTablePage';
  load_data();
  console.log('heehe');

  function load_data(page)
  {
    
       $.ajax({

            type:"POST",                
            data: {
              action:action, page:page
            },                
            dataType: "html",
            async: false,
            success:function(response){
              console.log('success');
              console.log(page);
              console.log(response);
              $('#pagination_data').html(response);                                            
            },
            error:function(){
              alert('error');
            }
       })
  }
    
  $(document).on('click', '.pagination_link', function(){
    console.log('click');
    console.log($(this));
    var page = $(this).attr("id");
    load_data(page);
  });

  // .not('.date-header:first')
  


  $(document).on('click', '#pagination_data tr:not(:first-child)', function(e){
    
    if(window.role_id==1){

console.log('tr');
console.log($(this));
console.log('#pagination_data tr td:last-child');
console.log($(e.target).closest('input').length);


    var choosenClass = $(this).parent().find('.choosen');

    $nearest_td = $(e.target).closest('td');

    $row = $nearest_td.parent();


console.log('$(e.target).parent().last()');


    
    if(choosenClass&&(!(choosenClass).is($(this)))){

      if(!($(e.target).closest('input').length>0)){
        choosenClass.removeClass('choosen');
      }

      id=$row.find('td').first().text();  

    }else{
      id='non selected for edit';  
    }
      
      if(!($(e.target).closest('input').length>0)){
    $(this).toggleClass('choosen');
  }

      

        


console.log('idsssssssssss');
console.log($row.find('td').first());
console.log(id);



$input_td = $(e.target).closest('input');
$row = $input_td.parent().parent();
$('#choosed_row').text('id: '+id);
       if($input_td.length>0){

console.log('$(this)');
console.log($(this));
console.log('$(this)');
console.log($(this).parent());
console.log($(this).parent().parent());
console.log('hasClass');

        var action = 'updateRowStatus';

        

        

console.log('$id');
console.log(id);
console.log($row.find('td').first().text());

var status=$row.find('td:last-child').find('input:checked').val();

if(!status){
  status=0;
}else{
  status=1;
}

console.log('status');
console.log(status);
console.log($row.find('td:last-child').find('input:checked'));

        rowStatusUpdate();
        console.log('heehe');

        function rowStatusUpdate(page)
        {
          
             $.ajax({
                  type:"POST",                
                  data: {
                    action:action, id:id, status:status
                  },                
                  dataType: "html",
                  async: false,
                  success:function(response){
                    console.log('success');  
                    console.log(response);                   
                  },
                  error:function(){
                    alert('error');
                  }
             })
        }
      

    }

  }else{
    $('#choosed_row').text(' ');
  }

  

  });


  

 });




//  $(document).ready(function(){

//   console.log('here');

//  $(document).on("click","body",function() {
        
// var something = 'HEHE )';


// var login = 'something';
// $.ajax({
    
//     type: "POST",
//     data: {
//       action:login, login:'admin', password:'111'
//     },
//     // url: "controllers/IndexController.php",
//     dataType: "html",
//     async: false,
    
//     success: function(data) {
//       $("body").html(data);
      
//       console.log('data');
//       console.log(data);
//     },
    
//     error: function(){
//       console.log('error');
//     }

//   });    

  // $.ajax({

  //     type: "POST",
  //     data: {
  //       invoiceno:'1'
  //     },
  //     dataType: "html",
  //     async: false,
  //     url:'/controllers/AjaxHandlerController.php',
     
  //    success: function(response){       
  //       console.log('Sucess');
  //       console.log(response);
  //       console.log('Sucess');

  //    },
  //    error: function(){
  //       console.log('error');
  //    }

      
  //   });

   //    });


 
   // $('#sel_user').change(function(){

   //  var username = $(this).val();
   //  $.ajax({
   //   url:'index.php/User/userDetails',
   //   method: 'post',
   //   data: {username: username},
   //   dataType: 'json',
   //   success: function(response){
   //     var len = response.length;
   //     $('#suname,#sname,#semail').text('');
   //     if(len > 0){
   //       // Read values
   //       var uname = response[0].username;
   //       var name = response[0].name;
   //       var email = response[0].email;
 
   //       $('#suname').text(uname);
   //       $('#sname').text(name);
   //       $('#semail').text(email);
 
   //     }
 
   //   }
   // });

 //  });
 // });
   
/* END PAGINATION OF TABLE  */
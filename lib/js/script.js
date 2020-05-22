
/* PAGINATION OF TABLE  */

$(document).ready(function(){
if(window.role_id!=1){
  window.role_id=0;
}


if(window.role_id==0){
  $(document).on('click', '#myTable', function(){      
    return false;
  })
}

var page = 1;

$(document).on('click', '#addBtn', function(){

    var action = 'addTask';

    var name=$('#name').val();
    var email=$('#email').val();
    var task=$('#task').val();    

    console.log(name);
    console.log(email);
    console.log(task);

    add_data(name, email, task);

    function add_data(name, email, task)
    {
      
         $.ajax({
              type:"POST",                
              data: {
                action:action, name:name, email:email, task:task,
              },                
              dataType: "html",
              async: false,
              success:function(response){
              console.log('added');
                   $('#pagination_data').html(response);                                           
              },
              error:function(){
                alert('error');
              }
         })

         load_data(page);
    }
  });


$(document).on('click', '#updateBtn', function(){

    var action = 'updateRowTask';
    
    

    var id = $('#choosed_row').text().match(/\d+/)[0];
    task=$('#task').val();
console.log(id);
console.log(task);
update_row_task(id,task);
    function update_row_task(id, task)
    {
      
         $.ajax({
              type:"POST",                
              data: {
                action:action, id:id, task:task
              },                
              dataType: "html",
              async: false,
              success:function(response){
                window.currentSelTask.text(task);        
              },
              error:function(){
                alert('error');
              }
         })

        
    }
  });


  




  var action = 'changeTablePage';
  load_data();

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
    page = $(this).attr("id");
    load_data(page);
    
    $('#choosed_row').text('id: non selected for edit');

    $('#task').val('');
    
    $('#addBtn').prop('disabled', false);
    $('#updateBtn').prop('disabled', true);
  });

  // .not('.date-header:first')
  


  $(document).on('click', '#pagination_data tr:not(:first-child)', function(e){
    
    if(window.role_id==1){


    var choosenClass = $(this).parent().find('.choosen');

    $nearest_td = $(e.target).closest('td');

    $row = $nearest_td.parent();


    if(choosenClass&&(!(choosenClass).is($(this)))){
  task=$row.find('td').eq(3).text()

      if(!($(e.target).closest('input').length>0)){
        choosenClass.removeClass('choosen');        
        $('#task').val(task);
      }

      id=$row.find('td').first().text();
      window.currentSelTask=$row.find('td').eq(3);
      ;
      

    }else{
      id='non selected for edit';
      $('#task').val(task);
      
      $('#addBtn').prop('disabled', false);
      $('#updateBtn').prop('disabled', true);
    }
      
    if(!($(e.target).closest('input').length>0)){
      var choosenClass = $(this).parent().find('.choosen');
      if(!(choosenClass.length>0)){
        $('#task').val(task);
        $('#addBtn').prop('disabled', true);
      $('#updateBtn').prop('disabled', false);
      }else{
        $('#task').val('');
        
      $('#addBtn').prop('disabled', false);
        $('#updateBtn').prop('disabled', true);
      }

      $(this).toggleClass('choosen');
      
      $('#choosed_row').text('id: '+id);
    }

$input_td = $(e.target).closest('input');
$row = $input_td.parent().parent();



if($input_td.length>0){

    
    var action = 'updateRowStatus';

    var status=$row.find('td:last-child').find('input:checked').val();

if(!status){
  status=0;
}else{
  status=1;
}

        rowStatusUpdate();
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


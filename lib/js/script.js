
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


function toggleFlag(value){
   var toggle = value ? false : true;
   
   return toggle;
}
function boolToOrder(value){
  if(value){
    toggle='ASC';
   }else{
    toggle='DESC';
   }
   return toggle;
}

var page = 1;

var tablesSortOrders=[true,true,true,true,true];
var ascDesc = 'ASC';
var tableHead = 'id';

$(document).on('click', '#myTable th', function(e){

console.log('th');



switch ($(this).text()) {

  case 'id':
  console.log('tablesSortOrders[0]');
    tablesSortOrders[0]=toggleFlag(tablesSortOrders[0]);
    ascDesc=boolToOrder(tablesSortOrders[0]);
    break;
  case 'name':    
  console.log('tablesSortOrders[1]');
    tablesSortOrders[1]=toggleFlag(tablesSortOrders[1]);
    ascDesc=boolToOrder(tablesSortOrders[1]);
    break;
  case 'email':
    tablesSortOrders[2]=toggleFlag(tablesSortOrders[2]);
    ascDesc=boolToOrder(tablesSortOrders[2]);
    break;
  case 'task':
    tablesSortOrders[3]=toggleFlag(tablesSortOrders[3]);
    ascDesc=boolToOrder(tablesSortOrders[3]);
    break;
  case 'status':
    tablesSortOrders[4]=toggleFlag(tablesSortOrders[4]);
    ascDesc=boolToOrder(tablesSortOrders[4]);
    break;

}

console.log('tableHead');
var tableHead=($(this).text());

console.log($(this).text());
console.log(tableHead);
console.log('tableHead');
console.log(ascDesc);

    load_data(page, tableHead, ascDesc);

  });

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

         load_data(page, tableHead, ascDesc);
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
  load_data(page,tableHead,ascDesc);

  function load_data(page, tableHead, ascDesc)
  {
    
       $.ajax({

            type:"POST",                
            data: {
              action:action, page:page, tableHead:tableHead, ascDesc:ascDesc
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
    load_data(page, tableHead, ascDesc);
    
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


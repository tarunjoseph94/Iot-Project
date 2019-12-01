$(document).ready(function(){
   $('.sidenav').sidenav();
   $('select').formSelect();
  $(".humidPrevious").ready(function()
  {
    let humid=parseInt($(".humidPrevious").text());
    //console.log(humid);
    if(humid>75)
    {
      $(".humidPrevious").addClass("red-text");
      $(".humidPrevious").removeClass("green-text");
    }
    else {
      $(".humidPrevious").addClass("green-text");
      $(".humidPrevious").removeClass("red-text");
    }
  });
  $(".tempPrevious").ready(function()
  {
    let temp=parseInt($(".tempPrevious").text());
    //console.log(humid);
    if(temp>28)
    {
      $(".tempPrevious").addClass("red-text");
      $(".tempPrevious").removeClass("green-text");
    }
    else {
      $(".tempPrevious").addClass("green-text");
      $(".tempPrevious").removeClass("red-text");
    }
  });
  $(".moistPrevious").ready(function()
  {
    let moist=parseInt($(".moistPrevious").text());
    //console.log(humid);
    if(moist<55)
    {
      $(".moistPrevious").addClass("red-text");
      $(".moistPrevious").removeClass("green-text");
    }
    else {
      $(".moistPrevious").addClass("green-text");
      $(".moistPrevious").removeClass("red-text");
    }
  });
  $(".lightPrevious").ready(function()
  {
    let light=parseInt($(".lightPrevious").text());
    //console.log(humid);
    if(light<50)
    {
      $(".lightPrevious").addClass("red-text");
      $(".lightPrevious").removeClass("green-text");
    }
    else {
      $(".lightPrevious").addClass("green-text");
      $(".lightPrevious").removeClass("red-text");
    }
  });
  $('#startDate').on('change', function (event) {
  event.preventDefault();
  let startpk=$("#startDate option:selected").val();
  var formData=new FormData();
      formData.append('startpk',startpk);
  $.ajax({
    url: "endDateSelectBox.php",
       data:formData,
       type:"POST",
       contentType: false,
       processData: false,
    success:function(result){
      $("#endDateResults").html(result);
    }});
  });
  $('#endDate').on('change', function (event) {
  event.preventDefault();
  let startpk=$("#startDate option:selected").val();
  let endpk=$("#endDate option:selected").val();
  var formData=new FormData();
      formData.append('startpk',startpk);
      formData.append('endpk',endpk);
  $.ajax({
    url: "renderDataDateRange.php",
       data:formData,
       type:"POST",
       contentType: false,
       processData: false,
    success:function(result){
      $("#graphResult").html(result);
    }});
  });


});

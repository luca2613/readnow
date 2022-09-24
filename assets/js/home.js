function muda(el) {
  var display = document.getElementById(el).style.display;
  if(display == "none") {
    document.getElementById(el).style.display = 'block';
      
  }else {
    document.getElementById(el).style.display = 'none';
      $('#formulario').each (function(){
        this.reset();
      });
      $('#upfile').val("");
      $('#file_upload').removeAttr('src');
  }
      
}

function readURL(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
          $('#file_upload') 
              .attr('src', e.target.result);
      };
      reader.readAsDataURL(input.files[0]);
  }
}
(function ($) {
      "use strict";
      var DT = {};
  
      DT.uploadImageToInput = () => {
          $('.upload-image').click(function () {
              let input = $(this);
              let type = input.attr('data-type');
              DT.setUpCkFinder2(input, type);
          });
      }
  
      DT.setUpCkFinder2 = (object, type) => {
          if (typeof (type) == 'undefined') {
              type = 'Images';
          }
          var finder = new CKFinder();
          finder.selectActionFunction = function (fileUrl, data) {
              object.val('/' + fileUrl);
              console.log(object.find('img').attr('src', '/' + fileUrl));
              object.closest('.box-image-finder').find('.show-image').attr('src', '/' + fileUrl)
          }
          finder.popup();
      }
  
      DT.uploadImageAvatar = () => {
          $('.image-target').click(function () {
              let input = $(this);
              DT.browServerAvatar(input, 'Images');
          });
      }
  
      DT.browServerAvatar = (object, type) => {
          if (typeof (type) == 'undefined') {
              type = 'Images';
          }
          var finder = new CKFinder();
          finder.selectActionFunction = function (fileUrl, data) {
              object.find('img').attr('src', '/' + fileUrl);
              object.siblings('input').val('/' + fileUrl);
          }

          finder.popup();
      }
  
      $(document).ready(function () {
          DT.uploadImageToInput();
          DT.uploadImageAvatar();
      });
  
  })(jQuery);
  
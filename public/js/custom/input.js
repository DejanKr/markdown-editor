$(function($, undefined) {
  /*
   $('body')
   .on('click','button',function(e){
   echo "#ergergewrg";
   });
   */
  var hasChanged = false;
  var interval = 1000;
  var docID;


  $('body')
    .on('blur', 'input', function(e) {
      e.preventDefault();

      var input = $(this);   //postane tisti input na katerega pritisneš

      var form = input
        .parents('form.form-vertical')
        .first();          //postane form-inline.form-vertical


      var inputs = form.find('input');  //arrray vseh teh inputov znotraj forma

      $.each(inputs, function() {
        var innerInput = $(this);

        //tukaj gre čez ta seznam inputov


        var formGroup = innerInput
          .parents('div.form-group')
          .first();              //tukaj za vsak input najde svojga starša s takimi podatki

        if (innerInput.val().length == 0) {
          formGroup.addClass('has-error');

          //vsak div nad svojim inputom dobi nov klas.
        }
        else {
          formGroup.removeClass('has-error');
        }
      });

      checkSave(form);


    });

  // input == undefined


  function checkSave(container) {


    var errors = container.find('.has-error');   //seznam objektov ki imajo klas has-error

    var saveBtn = container                           //save btn postane gumb
      .find('button.btn[data-action="save"]');

    // alert(errors.length);

    if (errors.length > 0) {
      saveBtn.prop('disabled', true);               //če je vsaj en objekt s klasom error potem gumb disejblamo

    }
    else {
      saveBtn.prop('disabled', false);
      var url = 'index.php?c=editor&a=save';
      //  var url = 'http://md-to-html.com/?c=editor&a=test';
      // var data = container.serialize();
      var documentID = container.find('input[name="document-id"]').val();  //iz hidden inputa shranimo vrednost
      docID = documentID;
      var name = container.find('input[name=docName]').val();
      var alias = container.find('input[name=alias]').val();
      var tags = container.find('input[name=tags]').val();

      var data = {
        'document-id' : documentID,
        'docName' : name,
        'alias' : alias,
        'tags' : tags
      };

      $.post(url, data).done(function(dataBack) {
          var hiddenInput = $('input[name="document-id"]');
          if (dataBack.documentID) {
            hiddenInput.val(dataBack.documentID);
          }
        }

      )
    }
  }

  $("#btn1").click(function() {
    //window.open("index.php?c=index&a=showList");
    window.location.replace("index.php?c=index&a=showList");
    /*
     var data = {
     'document-id' : documentID,
     'docName' : name,
     'alias' : alias,
     'tags' : tags
     };

     $.post(url, data).done(function(dataBack) {
     var hiddenInput = $('input[name="document-id"]');
     if (dataBack.documentID) {
     hiddenInput.val(dataBack.documentID);
     }
     }
     )
     */

  });

  $('.delete').click(function() {
    var current = $(this);
    var url = "index.php/?c=editor&a=deleteDocument";

    var id = current.parents('tr')
      .first()
      .find('.document-id')
      .data('document-id');

    var data = {'document-id' : id};

    $.post(url, data).done(function(dataBack) {
        location.reload();
      }
    );
  });


  if ($('input[name="document-id"]').length > 0) {

    setInterval(function() {

      if ($('input[name="document-id"]').val().length && hasChanged)     // v primeru, da je nekaj v hidden inputu in je prišlo do sprememb v textarea potem poskuša shranit
        saveCode();

    }, interval);

    $("textarea[name=textleft]").keyup(function() {
      hasChanged = true;
    });
  }

  function saveCode() {
    var data = {
      'document-id' : $('input[name="document-id"]').val(),
      'text' : getCode()
    };


    $.post('index.php?c=editor&a=save', data)
      .done(function(dataBack) {                //če se zadeva uspešno izvede se izvede tudi jedro funkcije.
        hasChanged = false;
        refreshPreview(true);
      });
  }


  function refreshPreview(overwriteHasChanged) {

    if (hasChanged || overwriteHasChanged) {
      var previewContainer = $('div.md-preview');
      var code = getCode();
      var url = "index.php?c=editor&a=generate";

      var data = {};
      data['document-id'] = $('input[name="document-id"]').val();
      data['code'] = code;
      $.post(url, data).done(function(dataBack) {
        console.log(dataBack);
        if (dataBack.status == 'success')
          previewContainer.html(dataBack.html);
        else
          alert(dataBack.message);
      })
    }
  }

  function getCode() {
    return $("textarea[name=textleft]").val();
  }
});
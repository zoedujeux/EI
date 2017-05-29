$(document).ready(function() {
    $('#newsletterForm').on('submit', function(e) {
        e.preventDefault();
 
        var $this = $(this);
 
        var mail = $('#mail').val();
 
        if(mail === '') {
            alert('Le champ doit être rempli');
        } else {
            $.ajax({
                url: $this.attr('action'),
                type: $this.attr('method'),
                data: $this.serialize(),
                dataType: 'json', 
                success: function(json) {
                    if(json.reponse === 'ok') {
                        alert('Tout est bon');
                    } else {
                        alert('Erreur : '+ json.reponse);
                    }
                }
            });
        }
    });
});



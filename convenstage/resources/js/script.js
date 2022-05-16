document.addEventListener('DOMContentLoaded', function() {
    for(a of document.getElementsByClassName('form_user'))
    {
        for(b of a.children)
        {
            b.addEventListener('click', function(){
                axios ({
                    method: 'POST',
                    url: '/users',
                    data: {
                        role: this.getAttribute('value'),
                        id: this.parentNode.children[1].value,
                    }
                })
                    .then(res => {
                        let a = document.getElementById('alert');
                            a.hidden = false;
                            a.innerText = res.data['message'];
                    });
            });
        }
    }


    $('#search-user').keyup(function(){
        $('#search-result').html('');

        var user = $(this).val();

        if(user != '')
        {
            $.ajax({
                url: '/users-search',
                method: 'GET',
                data: {
                    user: encodeURIComponent(user)
                },
                success: function(data)
                {
                    if(data != '')
                    {
                        document.getElementById('search-result').innerHTML = data;
                    }
                    else
                    {
                        document.getElementById('search-result').innerHTML = '<li class="list-group-item">Pas de résultat</li>';
                    }
                }
            });
        }
    });

    $('#search-suivis').keyup(function(){
        $('#search-result').html('');

        var user = $(this).val();

        if(user != '')
        {
            $.ajax({
                url: '/suivis-search',
                method: 'GET',
                data: {
                    user: encodeURIComponent(user)
                },
                success: function(data)
                {
                    if(data != '')
                    {
                        document.getElementById('search-result').innerHTML = data;
                    }
                    else
                    {
                        document.getElementById('search-result').innerHTML = '<li class="list-group-item">Pas de résultat</li>';
                    }
                }
            });
        }
    });

    $('#search-eleve').keyup(function(){
        $('#search-result').html('');

        var user = $(this).val();

        if(user != '')
        {
            $.ajax({
                url: '/users-eleve-search',
                method: 'GET',
                data: {
                    user: encodeURIComponent(user)
                },
                success: function(data)
                {
                    if(data != '')
                    {
                        document.getElementById('search-result').innerHTML = data;
                    }
                    else
                    {
                        document.getElementById('search-result').innerHTML = '<li class="list-group-item">Pas de résultat</li>';
                    }
                }
            });
        }
    });

});



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
});



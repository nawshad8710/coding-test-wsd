const register = (event) => {
    event.preventDefault();
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const role = document.getElementById('role').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    const data = { name, email, role, password };
    //console.log(data);

    if (password === confirmPassword) {
        fetch('../../data/users/register.php', {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {
                'Content-type': 'application/json' // sent request
            }
        })
            .then((res) => res.json())
            .then((data) => {
                console.log(data);
                if (data.status === 'user_exist') {
                    Swal.fire(
                        'Error!',
                        'Email already exists!',
                        'warning'
                    );
                } else if (data.status === 'success') {
                    window.location = data.url;
                } else {
                    Swal.fire('Error!', data.status, 'warning');
                }
            })
            .catch((error) => Swal.fire(error, '', 'error'));
    } else {
        Swal.fire("Password doesn't match", '', 'warning');
    }
};

const update = (event) => {
    event.preventDefault();
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const id = document.getElementById('user_id').value;
    const role = document.getElementById('role').value;
    const data = { name, email, role, id };

    fetch('../../data/users/update.php', {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
            'Content-type': 'application/json' // sent request
        }
    })
        .then((res) => res.json())
        .then((data) => {
            console.log(data);
            if (data.status === 'user_exist') {
                Swal.fire(
                    'Error!',
                    'Email already exists!',
                    'warning'
                );
            } else if (data.status === 'success') {
                window.location = data.url;
            } else {
                Swal.fire('Error!', data.status, 'warning');
            }
        })
        .catch((error) => Swal.fire(error, '', 'error'));
    
};

const updateProfile = (event) => {
    event.preventDefault();
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const id = document.getElementById('user_id').value;
    const role = document.getElementById('role').value;
    const data = { name, email, role, id };

    fetch('../data/users/update_profile.php', {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
            'Content-type': 'application/json' // sent request
        }
    })
        .then((res) => res.json())
        .then((data) => {
            console.log(data);
            if (data.status === 'user_exist') {
                Swal.fire(
                    'Error!',
                    'Email already exists!',
                    'warning'
                );
            } else if (data.status === 'success') {
                window.location = data.url;
            } else {
                Swal.fire('Error!', data.status, 'warning');
            }
        })
        .catch((error) => Swal.fire(error, '', 'error'));
    
};

const updatePassword = (event) => {
    event.preventDefault();
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    const id = document.getElementById('user_id').value;
    const data = { password, id };

    if (password === confirmPassword) {
        fetch('../data/users/update_password.php', {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {
                'Content-type': 'application/json' // sent request
            }
        })
            .then((res) => res.json())
            .then((data) => {
                console.log(data);
                if (data.status === 'user_exist') {
                    Swal.fire(
                        'Error!',
                        'Email already exists!',
                        'warning'
                    );
                } else if (data.status === 'success') {
                    window.location = data.url;
                } else {
                    Swal.fire('Error!', data.status, 'warning');
                }
            })
            .catch((error) => Swal.fire(error, '', 'error'));

    } else {
        Swal.fire("Password doesn't match", '', 'warning');
    }   
    
};

const deleteUser = (id) => {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#28a745',
        confirmButtonColor: '#dc3545',
        confirmButtonText: 'Yes, delete it!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`../data/users/delete.php?id=${id}`, {
                method: 'GET'
            })
                .then((res) => res.json())
                .then((data) => {
                    if (data.status === 'success') {
                        window.location.reload();
                    }
                })
                .catch((error) =>
                    Swal.fire('Something went wrong', '', 'warning')
                );
        }
    });
};

// create a new role
const newRole = (event) => {
    event.preventDefault();
    const name = document.getElementById('name').value;
    const data = { name };
    
        fetch('../../data/roles/new_role.php', {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {
                'Content-type': 'application/json' // sent request
            }
        })
        .then((res) => res.json())
        .then((data) => {
            console.log(data);
            if (data.status === 'success') {
                //redirecting
                window.location = data.url;
            } else {
                Swal.fire('Failed!', data.status, 'warning')
            }
        })
        .catch((error) => Swal.fire('Something went wrong', '', 'warning'));
};

//update role
const updateRole = (event) => {
    event.preventDefault();
    const name = document.getElementById('name').value;
    const id = document.getElementById('role_id').value;
    const data = { name, id };
    
        fetch('../../data/roles/update.php', {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {
                'Content-type': 'application/json' // sent request
            }
        })
        .then((res) => res.json())
        .then((data) => {
            console.log(data);
            if (data.status === 'success') {
                //redirecting
                window.location = data.url;
            } else {
                Swal.fire('Failed!', data.status, 'warning')
            }
        })
        .catch((error) => Swal.fire('Something went wrong', '', 'warning'));
};


const deleteRole = (id) => {
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
            fetch(`../../data/roles/delete.php?id=${id}`, {
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



function openRejectModal() {
    document.getElementById('ufRejectModal').style.display = 'block';
}

function closeRejectModal() {
    document.getElementById('ufRejectModal').style.display = 'none';
}

function toggleCustomReason() {
    var customReason = document.getElementById('ufCustomReason');
    var otherRadio = document.querySelector('input[name="reason"][value="other"]');

    if (otherRadio.checked) {
        customReason.style.display = 'block';
    } else {
        customReason.style.display = 'none';
    }
}

function submitRejectReason() {
    var selectedReason = document.querySelector('input[name="reason"]:checked');

    if (!selectedReason) {
        alert('Please select a reason');
        return;
    }
    // if(selectedReason.value=='bookcat-not-available'){
    //     if(document.getElementById("book-cat-reason").value.trim() == ""){
    //         alert("enter book category");
    //         return;
    //     }
    // }

    var selected_reason = selectedReason.value;
    var customReason = document.getElementById('ufCustomReason').value;

    if (selected_reason === 'other' && customReason.trim() === '') {
        alert('Please enter a custom reason');
        return;
    }
    else if (selected_reason === 'bookcat-not-available' && document.getElementById("book-cat-reason").value.trim() == "") {
        alert('enter book category');
        return;
    }
    else if (selected_reason === 'bookcat-not-available' && document.getElementById("book-cat-reason").value.trim() == "") {
        alert('enter book category');
        return;
    }


    document.getElementById('ufRejectForm').submit();
}

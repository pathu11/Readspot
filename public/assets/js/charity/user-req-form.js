
function openRejectModal() {
    document.getElementById('ufRejectModal').style.display = 'block';
}

function closeRejectModal() {
    document.getElementById('ufRejectModal').style.display = 'none';
}

function toggleCustomReason() {
    var customReason = document.getElementById('ufCustomReason');
    var CatReason = document.getElementById('book-cat-reason');
    var LocReason = document.getElementById('location-reason');
    var CountReason = document.getElementById('book-count-reason');
    var DateReason = document.getElementById('date-reason');

    var selectedReason = document.querySelector('input[name="reason"]:checked');
    var selected_reason = selectedReason.value;


    if (selected_reason === 'other') {
        customReason.style.display = 'block';
        CatReason.style.display = 'none';
        LocReason.style.display = 'none';
        CountReason.style.display = 'none';
        DateReason.style.display = 'none';
    }
    else if (selected_reason === 'bookcat-not-available') {
        customReason.style.display = 'none';
        CatReason.style.display = 'block';
        LocReason.style.display = 'none';
        CountReason.style.display = 'none';
        DateReason.style.display = 'none';
    }
    else if (selected_reason === 'location-not-available') {
        customReason.style.display = 'none';
        CatReason.style.display = 'none';
        LocReason.style.display = 'block';
        CountReason.style.display = 'none';
        DateReason.style.display = 'none';
    }
    else if (selected_reason === 'count-not-enough') {
        customReason.style.display = 'none';
        CatReason.style.display = 'none';
        LocReason.style.display = 'none';
        CountReason.style.display = 'block';
        DateReason.style.display = 'none';
    }
    else if (selected_reason === 'date-not-available' ) {
        customReason.style.display = 'none';
        CatReason.style.display = 'none';
        LocReason.style.display = 'none';
        CountReason.style.display = 'none';
        DateReason.style.display = 'block';
    }

    // if (otherRadio.checked) {
    //     customReason.style.display = 'block';
    // } else {
    //     customReason.style.display = 'none';
    // }
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
        alert('Please enter a reason');
        return;
    }
    else if (selected_reason === 'location-not-available' && document.getElementById("location-reason").value.trim() == "") {
        alert('Please enter a reason');
        return;
    }
    else if (selected_reason === 'count-not-enough' && document.getElementById("book-count-reason").value.trim() == "") {
        alert('Please enter a reason');
        return;
    }
    else if (selected_reason === 'date-not-available' && document.getElementById("date-reason").value.trim() == "") {
        alert('Please enter a reason');
        return;
    }


    document.getElementById('ufRejectForm').submit();
}

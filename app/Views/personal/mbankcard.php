<div class="container">
    <div class="d-flex align-items-center">
        <i class="bx bx-chevron-left d-xl-none d-lg-none d-md-none me-2" style="cursor: pointer;" onclick="history.back();"></i>
        <h6 class="text-uppercase d-xl-none d-lg-none d-md-none d-block m-0"><?=$secTitle;?></h6>
    </div>

    <div class="account-list" id="accountList">
        <!-- Accounts will be loaded here -->
    </div>

    <div class="my-3">
        <a href="<?=base_url('user/abank-account');?>" class="d-flex btn-bankcard w-100 justify-content-center align-items-center"><?=lang('Nav.addbank');?></a>
    </div>
</div>

<script>

    function loadBankAccounts() {
    $.ajax({
        url: '/list/raw/bank-account/user',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            renderBankAccounts(data.data);
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
}

function renderBankAccounts(accounts) {
    const accountList = document.getElementById('accountList');
    accountList.innerHTML = ''; // Clear current content

    // Sort the accounts: default first, then non-default alphabetically
    const sortedData = [...accounts].sort((a, b) => {
        // Default account always comes first
        if (a.isDefault === 1) return -1;
        if (b.isDefault === 1) return 1;
                
        // For non-default accounts, sort alphabetically by name
        return a.name.localeCompare(b.name);
    });

    sortedData.forEach((account, index) => {
        const isDefault = account.isDefault === 1;

        const accountCard = document.createElement('div');
        accountCard.className = `account-card px-2 py-2`;

        accountCard.innerHTML = `
            <div class="d-flex align-items-center justify-content-center">
                <div class="detail-item">
                    <div class="detail-value fw-semibold">${account.holder}</div>
                    <div class="detail-value fw-light">${account.name}</div>
                </div>

                <div class="detail-item ms-auto">
                    <div class="detail-value">
                        ${account.accno}
                        ${isDefault ? '✅' : ''}
                    </div>
                </div>
            </div>
        `;

        // Click to set default
        accountCard.addEventListener('click', () => {
            if (!isDefault) {
                setDefault(account.bank, account.holder, account.accno, account.cardno);
            }
        });

        // Animate
        accountCard.style.opacity = '0';
        accountCard.style.transform = 'translateY(20px)';
        accountCard.style.transition = 'all 0.5s ease';

        accountList.appendChild(accountCard);

        setTimeout(() => {
            accountCard.style.opacity = '1';
            accountCard.style.transform = 'translateY(0)';
        }, index * 100 + 100);
    });
}

function setDefault(bank, holder, accno, cardno) {
    var params = {};
    params['bank'] = bank;
    params['holder'] = holder;
    params['accno'] = accno;
    params['cardno'] = cardno;

    $.post('/user/bank-account/set-default', {params}, function(data, status) {
        let obj;

        try {
            obj = typeof data === 'string' ? JSON.parse(data) : data;
        } catch (e) {
            return swal.fire("Error!", "Invalid response from server.", "error");
        }

        if (obj.code === 1) {
            swal.fire("Success", "Default account updated successfully.", "success");
            
            // Reload updated list (based on your new setup)
            loadBankAccounts();


        } else {
            swal.fire("Error!", obj.message + " (Code: " + obj.code + ")", "error");
        }
    })
    .fail(function() {
        swal.fire("Error!", "Oops! Something went wrong. Please try again later.", "error");
    });
}


document.addEventListener('DOMContentLoaded', () => {
    loadBankAccounts();
});

</script>
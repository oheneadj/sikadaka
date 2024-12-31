<x-app-layout>
    <livewire:dashboard />
</x-app-layout>

<script>
    document.querySelectorAll('#card-drop-down-icon').forEach(icon => {
        icon.addEventListener('click', function() {
            icon.classList.add('rotate-180');
            icon.nextElementSibling.classList.toggle('hidden');
        })
    })

    document.querySelectorAll('#card-drop-down-icon').forEach(dropDown => {
        dropDown.addEventListener('blur', function() {
            dropDown.nextElementSibling.classList.add('hidden');
            dropDown.classList.remove('rotate-180');
        })
    })

    const monthOverview = [{
        month: 'January',
        donations: 1000,
        funeralWages: 2000,
        communityMembers: 1000,
        donors: 500
    }, {
        month: 'February',
        donations: 1500,
        funeralWages: 2500,
        communityMembers: 1200,
        donors: 600
    }, {
        month: 'March',
        donations: 2000,
        funeralWages: 3000,
        communityMembers: 1500,
        donors: 700
    }, {
        month: 'April',
        donations: 2500,
        funeralWages: 3500,
        communityMembers: 2000,
        donors: 800
    }]

    const yearlyOverview = [{
        year: 2022,
        donations: 25000,
        funeralWages: 35000,
        communityMembers: 5000,
        donors: 2500
    }, {
        year: 2023,
        donations: 45000,
        funeralWages: 55000,
        communityMembers: 8000,
        donors: 4000
    }, {
        year: 2023,
        donations: 45000,
        funeralWages: 55000,
        communityMembers: 8000,
        donors: 4000
    }, {
        year: 2024,
        donations: 72000,
        funeralWages: 85000,
        communityMembers: 12000,
        donors: 6000
    }];

    const populateYearlyOverview = (isDonor) => {
        const monthlyOverview = document.getElementById('yearly-overview');
        const overviewTitle = document.getElementById('year-overview-title');
        if (isDonor) {
            overviewTitle.innerHTML = 'Yearly Donations';
        } else {
            overviewTitle.innerHTML = 'Yearly Contribution';
        }
        monthlyOverview.innerHTML = '';
        yearlyOverview.forEach(year => {
            const li = document.createElement('li');
            li.className = 'py-4 hover:bg-gray-50 transition-colors duration-200';
            li.innerHTML = `<div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-900 mb-1">
                    ${year.year}
                </p>
                <p class="text-sm text-gray-500">
                    ${!isDonor ? year.communityMembers : year.donors}
                </p>
            </div>
            <div class="text-sm font-semibold text-gray-800">
                GH₵ ${!isDonor ? year.funeralWages : year.donations}
            </div>
        </div>`
            monthlyOverview.appendChild(li);
        });
    }

    populateYearlyOverview(false);

    const populateMonthlyOverview = (isDonor) => {
        const monthlyOverview = document.getElementById('monthly-overview');
        const overviewTitle = document.getElementById('overview-title');
        if (isDonor) {
            overviewTitle.innerHTML = 'Monthly Donations';
        } else {
            overviewTitle.innerHTML = 'Monthly Contribution';
        }
        monthlyOverview.innerHTML = '';
        monthOverview.forEach(month => {
            const li = document.createElement('li');
            li.className = 'py-4 hover:bg-gray-50 transition-colors duration-200';
            li.innerHTML = `<div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-900 mb-1">
                        ${month.month}
                    </p>
                    <p class="text-sm text-gray-500">
                        ${!isDonor ? month.communityMembers : month.donors}
                    </p>
                </div>
                <div class="text-sm font-semibold text-gray-800">
                    GH₵ ${!isDonor ? month.funeralWages : month.donations}
                </div>
            </div>`
            monthlyOverview.appendChild(li);
        });
    }

    populateMonthlyOverview(false);

    document.querySelectorAll('#monthly-drop-down-icon').forEach(icon => {
        icon.addEventListener('click', function() {
            icon.classList.add('rotate-180');
            icon.nextElementSibling.classList.toggle('hidden');
        })
    })

    document.querySelectorAll('#monthly-drop-down-icon').forEach(dropDown => {
        dropDown.addEventListener('blur', function() {
            dropDown.nextElementSibling.classList.add('hidden');
            dropDown.classList.remove('rotate-180');
        })
    })
</script>

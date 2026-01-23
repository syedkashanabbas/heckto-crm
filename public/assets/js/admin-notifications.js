document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('admin-notification-list');
    const badge = document.getElementById('admin-notification-count');

    if (!container) return;

    fetch('/admin/notifications/list', {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
        }
    })
    .then(res => res.json())
    .then(res => {
        badge.innerText = res.count;

        if (!res.items.length) {
            container.innerHTML = '<p class="text-sm text-slate-400">No notifications</p>';
            return;
        }

        container.innerHTML = res.items.map(n => `
            <div class="flex items-center space-x-3">
                <div class="flex items-center justify-center rounded-lg size-10 bg-secondary/10">
                    <i class="fa fa-user-clock text-secondary"></i>
                </div>
                <div>
                    <p class="font-medium text-slate-700">
                        ${n.data.user_name ?? 'System'}
                    </p>
                    <p class="text-xs text-slate-400">
                        ${n.type.replace(/([A-Z])/g, ' $1').trim()} · ${n.created_at}
                    </p>
                </div>
            </div>
        `).join('');
    })
    .catch(err => {
        console.error('Notification fetch failed', err);
    });
});

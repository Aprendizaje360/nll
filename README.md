[
    {
        "competenceId": 17,
        "label": "Regular",
        "watching": "Beta",
        "reflecting": "Alpha",
        "responding": "Alpha"
    },
    {
        "competenceId": 18,
        "label": "Excelente",
        "watching": "Alpha",
        "reflecting": "Beta",
        "responding": "Beta"
    },
    {
        "competenceId": 19,
        "label": "Bueno",
        "watching": "Beta",
        "reflecting": "Beta",
        "responding": "Beta"
    },
    {
        "competenceId": 20,
        "label": "Malo",
        "watching": "Alpha",
        "reflecting": "Beta",
        "responding": "Beta"
    },
    {
        "competenceId": 21,
        "label": "Regular",
        "watching": "Beta",
        "responding": "Alpha"
    }
]

[program:muse-worker]
command=php /var/www/muse php artisan queue:work
autostart=true
autorestart=true
user=root
redirect_stderr=true
stdout_logfile=/var/log/muse.out.log
stderr_logfile=/var/log/muse.err.log

sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start muse-worker:*
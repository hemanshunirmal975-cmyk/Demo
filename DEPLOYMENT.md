# Deploying Laravel Backend to Railway

This guide walks you through deploying your Laravel application to Railway with PostgreSQL database.

## Prerequisites

- Railway account (sign up at [railway.app](https://railway.app))
- Git repository initialized and committed

## Step 1: Prepare Your Repository

Ensure all Railway configuration files are committed:

```bash
git add .
git commit -m "Add Railway deployment configuration"
git push
```

## Step 2: Create Railway Project & Add PostgreSQL

### Option A: Using Railway Dashboard (Recommended)

1. **Go to Railway Dashboard**
   - Visit [railway.app/new](https://railway.app/new)
   - Click "Deploy from GitHub repo"

2. **Connect Your Repository**
   - Authorize Railway to access your GitHub account
   - Select your repository
   - Click "Deploy Now"

3. **Add PostgreSQL Database**
   - In your project dashboard, click "+ New"
   - Select "Database" → "Add PostgreSQL"
   - Railway will automatically create a PostgreSQL instance

### Option B: Using Railway CLI

```bash
# Install Railway CLI
npm i -g @railway/cli

# Login to Railway
railway login

# Initialize new project
railway init

# Add PostgreSQL
railway add --database postgresql

# Link to your project
railway link
```

## Step 3: Configure Environment Variables

In the Railway dashboard, go to your app service → **Variables** tab and add:

### Required Variables

```env
APP_NAME=LaravelApp
APP_ENV=production
APP_KEY=<generate-using-php-artisan-key-generate>
APP_DEBUG=false
APP_URL=https://your-app-name.up.railway.app

# Database (Railway will auto-fill these when you connect PostgreSQL)
DB_CONNECTION=pgsql
DB_HOST=${{Postgres.PGHOST}}
DB_PORT=${{Postgres.PGPORT}}
DB_DATABASE=${{Postgres.PGDATABASE}}
DB_USERNAME=${{Postgres.PGUSER}}
DB_PASSWORD=${{Postgres.PGPASSWORD}}

# Session & Cache
SESSION_DRIVER=database
SESSION_LIFETIME=120
CACHE_STORE=database
QUEUE_CONNECTION=database

# Logging
LOG_CHANNEL=stack
LOG_LEVEL=error

# Other
BCRYPT_ROUNDS=12
```

### Generate APP_KEY

Run locally and copy the output:
```bash
php artisan key:generate --show
```

### Connecting Database Variables

Railway provides reference variables for PostgreSQL. Use these formats:
- `${{Postgres.PGHOST}}`
- `${{Postgres.PGPORT}}`
- `${{Postgres.PGDATABASE}}`
- `${{Postgres.PGUSER}}`
- `${{Postgres.PGPASSWORD}}`

Replace `Postgres` with your actual database service name if different.

## Step 4: Deploy

### Automatic Deployment

Railway will automatically deploy when you push to your connected branch:

```bash
git push origin main
```

### Manual Deployment

In Railway dashboard:
1. Go to your service
2. Click "Deployments" tab
3. Click "Deploy" or trigger redeploy

### Monitor Build Logs

1. Click on the latest deployment
2. View "Build Logs" tab to monitor progress
3. Check for any errors

## Step 5: Verify Deployment

### Check Application Health

Once deployed, Railway will provide a URL like: `https://your-app.up.railway.app`

Test basic connectivity:
```bash
curl https://your-app.up.railway.app
```

### Test API Endpoints

```bash
# Get employees (requires authentication)
curl https://your-app.up.railway.app/api/employees

# Test login
curl -X POST https://your-app.up.railway.app/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"your-email@example.com","password":"your-password"}'
```

### Check Database Migrations

Via Railway CLI:
```bash
railway run php artisan migrate:status
```

Or check logs in Railway dashboard to see if migrations ran successfully.

## Step 6: Update Frontend

Update your frontend environment file to point to the Railway URL:

**employee-frontend/.env** (or .env.local):
```env
VITE_API_BASE_URL=https://your-app.up.railway.app/api
```

## Troubleshooting

### Build Fails with "config:cache" Error

✅ **Fixed!** The `nixpacks.toml` configuration skips problematic cache commands during build.

### Database Connection Issues

1. Verify PostgreSQL is added to your project
2. Check that database reference variables are correctly set
3. Ensure `DB_CONNECTION=pgsql` (not `mysql` or `sqlite`)

### Migration Errors

Check that all migrations are compatible with PostgreSQL:
- SQLite's `AUTOINCREMENT` → PostgreSQL uses `SERIAL`
- Use `$table->id()` in migrations (Laravel handles differences)

### App Key Error

Generate and set `APP_KEY`:
```bash
php artisan key:generate --show
```
Copy the output and set it in Railway variables.

### View Logs

```bash
# Using Railway CLI
railway logs

# Or check in dashboard under "Deployments" → "Logs"
```

## Database Seeding (Optional)

To seed your production database:

```bash
railway run php artisan db:seed
```

⚠️ **Warning**: Only seed once to avoid duplicate data.

## Going Live

1. **Configure Custom Domain** (optional)
   - Railway Settings → Domains → Add custom domain
   - Update DNS records as instructed
   - Update `APP_URL` environment variable

2. **Enable HTTPS** (automatic)
   - Railway provides SSL certificates automatically

3. **Monitor Performance**
   - Check Railway metrics dashboard
   - Set up logging/monitoring as needed

## Useful Commands

```bash
# View environment variables
railway variables

# Run artisan commands
railway run php artisan <command>

# Open railway dashboard for project
railway open

# View deployment logs
railway logs

# Restart service
railway restart
```

---

## Quick Reference: Environment Variables

| Variable | Value | Notes |
|----------|-------|-------|
| `APP_ENV` | `production` | Required |
| `APP_DEBUG` | `false` | Never `true` in production |
| `DB_CONNECTION` | `pgsql` | PostgreSQL driver |
| `DB_HOST` | `${{Postgres.PGHOST}}` | Railway auto-fills |
| `APP_KEY` | `base64:...` | Generate with artisan |
| `APP_URL` | `https://your-app.up.railway.app` | Your Railway URL |

---

**Next Steps**: After deployment succeeds, test all API endpoints from your frontend application.

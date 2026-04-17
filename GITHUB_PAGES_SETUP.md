# GitHub Pages Setup (No Render)

This project can be hosted as a static website on GitHub Pages.

## 1) Enable GitHub Pages

In repository settings for `23sc4122ms-sys/SmartHub`:

- Go to **Settings > Pages**
- Source: **Deploy from a branch**
- Branch: **main**
- Folder: **/docs**
- Save

GitHub Pages URL will be:

- `https://23sc4122ms-sys.github.io/SmartHub/`

## 2) Confirmation page URL

Use this URL in Supabase auth redirect allow-list and in local backend config:

- `https://23sc4122ms-sys.github.io/SmartHub/email-confirmation/`

## 3) Supabase redirect allow-list

In Supabase Dashboard > Authentication > URL Configuration:

- Site URL: `https://23sc4122ms-sys.github.io/SmartHub/`
- Redirect URLs:
  - `https://23sc4122ms-sys.github.io/SmartHub/email-confirmation/`

## 4) Local SmartHub config

Set in `supabase.local.json`:

```json
{
  "SMARTHUB_SUPABASE_EMAIL_REDIRECT_URL": "https://23sc4122ms-sys.github.io/SmartHub/email-confirmation/"
}
```

## Notes

- GitHub Pages is static only.
- Laravel server-side routes/controllers are not executed on GitHub Pages.
- For this SmartHub setup, that is fine because registration/login run in the Windows app backend.

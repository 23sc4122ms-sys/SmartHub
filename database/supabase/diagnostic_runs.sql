-- Per-user diagnostic history storage for SmartHub desktop backend.
-- Run this in Supabase SQL Editor.

create table if not exists public.diagnostic_runs (
  id bigint generated always as identity primary key,
  owner_user_id uuid not null,
  diagnostic_type text not null,
  device_id text not null,
  run_id bigint not null,
  run_timestamp bigint not null,
  payload jsonb not null,
  created_at timestamptz not null default now()
);

create index if not exists diagnostic_runs_owner_device_ts_idx
  on public.diagnostic_runs (owner_user_id, diagnostic_type, device_id, run_timestamp desc);

create index if not exists diagnostic_runs_run_id_idx
  on public.diagnostic_runs (run_id);

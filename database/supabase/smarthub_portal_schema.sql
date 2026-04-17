-- SmartHub Portal schema export for Supabase Postgres
-- Generated from current Laravel migrations in website/database/migrations.
-- Safe to run multiple times (uses IF NOT EXISTS / ON CONFLICT DO NOTHING).

BEGIN;

-- Track migration state so Laravel will not try to recreate these tables.
CREATE TABLE IF NOT EXISTS migrations (
    id BIGSERIAL PRIMARY KEY,
    migration VARCHAR(255) NOT NULL,
    batch INTEGER NOT NULL
);

CREATE UNIQUE INDEX IF NOT EXISTS migrations_migration_unique
    ON migrations (migration);

CREATE TABLE IF NOT EXISTS users (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    email_verified_at TIMESTAMP(0) WITHOUT TIME ZONE NULL,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP(0) WITHOUT TIME ZONE NULL,
    updated_at TIMESTAMP(0) WITHOUT TIME ZONE NULL
);

CREATE TABLE IF NOT EXISTS password_reset_tokens (
    email VARCHAR(255) PRIMARY KEY,
    token VARCHAR(255) NOT NULL,
    created_at TIMESTAMP(0) WITHOUT TIME ZONE NULL
);

CREATE TABLE IF NOT EXISTS sessions (
    id VARCHAR(255) PRIMARY KEY,
    user_id BIGINT NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    payload TEXT NOT NULL,
    last_activity INTEGER NOT NULL
);

CREATE INDEX IF NOT EXISTS sessions_user_id_index
    ON sessions (user_id);

CREATE INDEX IF NOT EXISTS sessions_last_activity_index
    ON sessions (last_activity);

CREATE TABLE IF NOT EXISTS cache (
    key VARCHAR(255) PRIMARY KEY,
    value TEXT NOT NULL,
    expiration BIGINT NOT NULL
);

CREATE INDEX IF NOT EXISTS cache_expiration_index
    ON cache (expiration);

CREATE TABLE IF NOT EXISTS cache_locks (
    key VARCHAR(255) PRIMARY KEY,
    owner VARCHAR(255) NOT NULL,
    expiration BIGINT NOT NULL
);

CREATE INDEX IF NOT EXISTS cache_locks_expiration_index
    ON cache_locks (expiration);

CREATE TABLE IF NOT EXISTS jobs (
    id BIGSERIAL PRIMARY KEY,
    queue VARCHAR(255) NOT NULL,
    payload TEXT NOT NULL,
    attempts SMALLINT NOT NULL CHECK (attempts >= 0),
    reserved_at INTEGER NULL CHECK (reserved_at IS NULL OR reserved_at >= 0),
    available_at INTEGER NOT NULL CHECK (available_at >= 0),
    created_at INTEGER NOT NULL CHECK (created_at >= 0)
);

CREATE INDEX IF NOT EXISTS jobs_queue_index
    ON jobs (queue);

CREATE TABLE IF NOT EXISTS job_batches (
    id VARCHAR(255) PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    total_jobs INTEGER NOT NULL,
    pending_jobs INTEGER NOT NULL,
    failed_jobs INTEGER NOT NULL,
    failed_job_ids TEXT NOT NULL,
    options TEXT NULL,
    cancelled_at INTEGER NULL,
    created_at INTEGER NOT NULL,
    finished_at INTEGER NULL
);

CREATE TABLE IF NOT EXISTS failed_jobs (
    id BIGSERIAL PRIMARY KEY,
    uuid VARCHAR(255) NOT NULL UNIQUE,
    connection TEXT NOT NULL,
    queue TEXT NOT NULL,
    payload TEXT NOT NULL,
    exception TEXT NOT NULL,
    failed_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS personal_access_tokens (
    id BIGSERIAL PRIMARY KEY,
    tokenable_type VARCHAR(255) NOT NULL,
    tokenable_id BIGINT NOT NULL,
    name TEXT NOT NULL,
    token VARCHAR(64) NOT NULL UNIQUE,
    abilities TEXT NULL,
    last_used_at TIMESTAMP(0) WITHOUT TIME ZONE NULL,
    expires_at TIMESTAMP(0) WITHOUT TIME ZONE NULL,
    created_at TIMESTAMP(0) WITHOUT TIME ZONE NULL,
    updated_at TIMESTAMP(0) WITHOUT TIME ZONE NULL
);

CREATE INDEX IF NOT EXISTS personal_access_tokens_tokenable_type_tokenable_id_index
    ON personal_access_tokens (tokenable_type, tokenable_id);

CREATE INDEX IF NOT EXISTS personal_access_tokens_expires_at_index
    ON personal_access_tokens (expires_at);

INSERT INTO migrations (migration, batch)
VALUES
    ('0001_01_01_000000_create_users_table', 1),
    ('0001_01_01_000001_create_cache_table', 1),
    ('0001_01_01_000002_create_jobs_table', 1),
    ('2026_04_17_043453_create_personal_access_tokens_table', 1)
ON CONFLICT (migration) DO NOTHING;

COMMIT;

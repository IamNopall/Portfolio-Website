-- Create public storage bucket for portfolio media
INSERT INTO storage.buckets (id, name, public, file_size_limit, allowed_mime_types)
VALUES (
    'portfolio',
    'portfolio',
    true,
    10485760, -- 10MB limit
    ARRAY['image/jpeg', 'image/png', 'image/webp', 'image/gif', 'image/svg+xml']
)
ON CONFLICT (id) DO UPDATE SET
    public = true,
    file_size_limit = 10485760;

-- Drop existing policies if any
DROP POLICY IF EXISTS "Public Storage Select" ON storage.objects;
DROP POLICY IF EXISTS "Public Storage Insert" ON storage.objects;
DROP POLICY IF EXISTS "Public Storage Update" ON storage.objects;
DROP POLICY IF EXISTS "Public Storage Delete" ON storage.objects;

-- Create permissive storage policies for portfolio bucket
CREATE POLICY "Public Storage Select"
ON storage.objects FOR SELECT
USING (bucket_id = 'portfolio');

CREATE POLICY "Public Storage Insert"
ON storage.objects FOR INSERT
WITH CHECK (bucket_id = 'portfolio');

CREATE POLICY "Public Storage Update"
ON storage.objects FOR UPDATE
USING (bucket_id = 'portfolio')
WITH CHECK (bucket_id = 'portfolio');

CREATE POLICY "Public Storage Delete"
ON storage.objects FOR DELETE
USING (bucket_id = 'portfolio');

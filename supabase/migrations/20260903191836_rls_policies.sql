-- Enable RLS on tables
ALTER TABLE public.projects ENABLE ROW LEVEL SECURITY;
ALTER TABLE public.admin_access ENABLE ROW LEVEL SECURITY;

-- Allow public read access to projects
CREATE POLICY "Allow public read access on projects"
ON public.projects FOR SELECT
USING (true);

-- Allow public insert/update/delete on projects (for portfolio manager)
CREATE POLICY "Allow public all access on projects"
ON public.projects FOR ALL
USING (true)
WITH CHECK (true);

-- Allow public access on admin_access for PIN verification
CREATE POLICY "Allow public access on admin_access"
ON public.admin_access FOR ALL
USING (true)
WITH CHECK (true);

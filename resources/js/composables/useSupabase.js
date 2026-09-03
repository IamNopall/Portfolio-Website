import { createClient } from '@supabase/supabase-js';

const supabaseUrl = import.meta.env.VITE_PUBLIC_SUPABASE_URL || 'https://hmycgkcmihsgxkdraote.supabase.co';
const supabaseAnonKey = import.meta.env.VITE_PUBLIC_SUPABASE_ANON_KEY || 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImhteWNna2NtaWhzZ3hrZHJhb3RlIiwicm9sZSI6ImFub24iLCJpYXQiOjE3ODg0NTY1NTAsImV4cCI6MjEwNDAzMjU1MH0.vD_WBoNzKSBnmPWFpjBbtyrHOV92oXe1aR2iVGX1krE';

export const supabase = createClient(supabaseUrl, supabaseAnonKey);

User::create([
    'name' => 'Agung prasetyo',
    'email' => 'agung@gmail.com',
    'password' => bcrypt('agungpass'),
]);
User::create([
    'name' => 'Agung prasetyo',
    'email' => 'adminagung@gmail.com',
    'is_admin' => true,
    'password' => bcrypt('agungpass'),
]);
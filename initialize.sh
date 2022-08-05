#!/usr/bin/env bash
set -e;


if ! docker info > /dev/null 2>&1; then
    echo -e "O Docker não está em execução." >&2;
    exit 1;
fi

function onError()
{
    echo '';
    echo -e '┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━';
echo -e '┃ 💥 [1;31mParece que algo deu errado![0m';
echo -e '┃ ';
    echo -e '┃ Sinta-se à vontade para abrir um problema no GitHub clicando no link abaixo..';
    echo -e '┃ ';
    echo -e '┃ Certifique-se de incluir informações úteis, como:';
    echo -e '┃ - a saída de erro acima';
    echo -e '┃ - a configuração escolhida antes de baixar o arquivo';
    echo -e '┃ - seu ambiente local (sistema operacional, etc.)';
    echo -e '┃ - outras informações que lhe pareçam relevantes';
    echo -e '┃ ';
    echo -e '┃ \033[1mhttps://github.com/NiclasvanEyk/initializer-for-laravel/issues/new\033[0m';
echo -e '┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━';    echo '';
}
trap onError ERR;
trap 'echo -e "\nCancelled"; exit 0;' INT;
echo '';
echo -e '┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━';
echo -e '┃ 🚀 [1mInitializer for Laravel[0m';
echo -e '┃ ';
echo -e '┃ This script will complete the rest of the setup needed to install the';
echo -e '┃ chosen components into your fresh application. This might require';
echo -e '┃ downloading Docker containers or requiring packages via composer';
echo -e '┃ multiple times, so it can take a while to complete.';
echo -e '┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━';if [ -t 1 ];
then
    echo '';
    read -n 1 -s -r -p "Press any key to continue";
    echo '';
else
    echo '';
fi

echo '';
echo -e '┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━';
echo -e '┃ 🚀 [1mInstale dependências e configure o Laravel Sail[0m';

echo -e '┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━';echo '';

echo 'Executando a instalação inicial dentro '\''initializerforlaravel/sail-php-8.1:latest'\'''
docker run --rm \
    -e WWWUSER=$(id -u) \
    -v "$(pwd)":/opt \
    -w /opt \
    "initializerforlaravel/sail-php-8.1:latest" \
    bash -c "composer install && php -r \"file_exists('.env') || copy('.env.example', '.env');\" && php artisan key:generate --ansi && php artisan sail:install --with=mysql,redis,meilisearch,mailhog && perl -0777 -pi -e 's/\.\/vendor\/laravel\/sail\/runtimes\/\d\.\d/.\/vendor\/laravel\/sail\/runtimes\/8.1/g' docker-compose.yml && perl -0777 -pi -e 's/sail-\d\.\d\/app/sail-8.1\/app/g' docker-compose.yml"
echo '';
echo -e '┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━';
echo -e '┃ 🚀 [1mAjustar permissões[0m';

echo -e '┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━';echo '';

echo 'read -p "" $USER .'
    if read -n 2>/dev/null; then
        read -p "" $USER
    else
        echo -e "Forneça sua senha para que possamos fazer alguns ajustes finais nas permissões do seu aplicativo."
        echo ""
        read -p "" $USER
    fi
echo '';
echo -e '┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━';
echo -e '┃ 🚀 [1mIniciar Laravel Sail[0m';

echo -e '┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━';echo '';

echo './vendor/bin/sail up -d'
./vendor/bin/sail up -d
echo '';
echo -e '┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━';
echo -e '┃ 🚀 [1mConifigurar Laravel Scout[0m';

echo -e '┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━';echo '';

echo './vendor/bin/sail artisan --no-interaction vendor:publish --provider="Laravel\Scout\ScoutServiceProvider"'
./vendor/bin/sail artisan --no-interaction vendor:publish --provider="Laravel\Scout\ScoutServiceProvider"
echo '';
echo -e '┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━';
echo -e '┃ 🚀 [1mMigrar o banco de dados[0m';

echo -e '┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━';echo '';

echo 'Aguardando o banco de dados aceitar conexões ...'
attempt=1;
maxAttempts=5;
sleepTime=5;
until ./vendor/bin/sail artisan tinker --execute 'try { DB::statement("select true"); echo("DB ready"); } catch (Throwable $e) { exit(1); }' | grep -q "DB ready" || [ $attempt -eq $maxAttempts ]; do
    echo "Falha na tentativa $attempt, tentando novamente em ${sleepTime}s...";
    ((attempt=attempt+1));
    sleep $sleepTime;
done

if [ "$attempt" -eq "$maxAttempts" ]; then
    echo "Não foi possível conectar ao banco de dados após tentativas de $attempt! Abortando...";
    exit 1;
fi

echo "Banco de dados pronto!"
echo './vendor/bin/sail artisan migrate'
./vendor/bin/sail artisan migrate
echo '';
echo -e '┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━';
echo -e '┃ 🚀 [1mConfigurar front-end[0m';

echo -e '┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━';echo '';

echo './vendor/bin/sail npm install '
./vendor/bin/sail npm install 
echo './vendor/bin/sail npm run build'
./vendor/bin/sail npm run build

echo "Configuração finalizada, removendo inicializar e TODOs no README.md!";

# Remove TODO in readme
perl -0777 -pi -e 's/<!-- Inicializador para Laravel Todos START  -->.*<!-- Inicializador para Laravel Todos END  -->//gs' README.md
echo '';
echo -e '┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━';
echo -e '┃ 🚀 [1mDone![0m';
echo -e '┃ ';
echo -e '┃ Agora você pode dar uma olhada em README.md, para mais instruções, guias';
echo -e '┃ e links para os componentes instalados.';
echo -e '┃ ';
echo -e '┃ Alguns links úteis:';
echo -e '┃ - Seu aplicativo http://localhost';
echo -e '┃ - Visualizar e-mails via Mailhog http://localhost:8025';
echo -e '┃ - Painel de administração do MeiliSearch http://localhost:7700';
echo -e '┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━';echo '';
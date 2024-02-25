<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GoogleCloudCredential;
use Google\Cloud\Storage\StorageClient;

class GoogleCloudCredentialsController extends Controller
{

    protected $storage;
    protected $bucket;
    
    public function __construct()
    {
    
    $credentials = $this->getGoogleCloudCredentials();

    $this->storage = new StorageClient([
        'credentials' => [
            'type' => 'service_account',
            'project_id' => $credentials->project_id,
            'private_key_id' => $credentials->private_key_id,
            'private_key' => $credentials->private_key,
            'client_email' => $credentials->client_email,
            'client_id' => $credentials->client_id,
            'auth_uri' => 'https://accounts.google.com/o/oauth2/auth',
            'token_uri' => 'https://oauth2.googleapis.com/token',
            'auth_provider_x509_cert_url' => 'https://www.googleapis.com/oauth2/v1/certs',
            'client_x509_cert_url' => 'https://www.googleapis.com/robot/v1/metadata/x509/your-service-account-email'
        ]
    ]);

    $this->bucket = $this->storage->bucket(env('GOOGLE_CLOUD_STORAGE_BUCKET'));
}

protected function getGoogleCloudCredentials()
    {
        // Aquí puedes implementar la lógica para recuperar las credenciales de la base de datos
        // basadas en el usuario o cualquier otro criterio.
        // Por ejemplo, si tienes un tipo de usuario específico que requiere credenciales
        // diferentes, puedes filtrar las credenciales basadas en el tipo de usuario.

        // Este es un ejemplo simplificado. Asegúrate de ajustarlo según tus necesidades.
        return GoogleCloudCredential::first();
    }
}
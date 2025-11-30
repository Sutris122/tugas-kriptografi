<?php


namespace App\Controllers;


use App\Controllers\BaseController;
use App\Models\ContactModel;


helper('form');
helper('stream_xor');


class Contacts extends BaseController
{
    private $model;
    // SECRET KEY: di contoh ini diset di sini; lebih baik simpan di .env
    private $secretKey;


    public function __construct()
    {
        $this->model = new ContactModel();
        $this->secretKey = getenv('STREAM_XOR_KEY') ?: 'default_test_key_please_change';
    }


    public function index()
    {
        $data['contacts'] = $this->model->findAll();


        // decrypt each record for display
        foreach ($data['contacts'] as &$c) {
            $c['name'] = xor_decrypt_hex($c['name_enc'], $this->secretKey, $c['nonce_hex']);
            $c['email'] = xor_decrypt_hex($c['email_enc'], $this->secretKey, $c['nonce_hex']);
        }


        return view('contacts/index', $data);
    }


    public function create()
    {
        return view('contacts/create');
    }


    public function store()
    {
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');


        // create nonce
        $nonce = random_bytes(12); // 12 bytes
        $nonce_hex = bin2hex($nonce);


        $name_enc = xor_encrypt_hex($name, $this->secretKey, $nonce_hex);
        $email_enc = xor_encrypt_hex($email, $this->secretKey, $nonce_hex);


        $this->model->insert([
            'name_enc' => $name_enc,
            'email_enc' => $email_enc,
            'nonce_hex' => $nonce_hex,
        ]);


        return redirect()->to('/contacts');
    }


    public function edit($id = null)
    {
        $c = $this->model->find($id);
        if (! $c) return redirect()->to('/contacts');


        $c['name'] = xor_decrypt_hex($c['name_enc'], $this->secretKey, $c['nonce_hex']);
        $c['email'] = xor_decrypt_hex($c['email_enc'], $this->secretKey, $c['nonce_hex']);


        return view('contacts/edit', ['contact' => $c]);
    }

    public function update($id = null)
    {
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        // create new nonce
        $nonce = random_bytes(12); // 12 bytes
        $nonce_hex = bin2hex($nonce);
        $name_enc = xor_encrypt_hex($name, $this->secretKey, $nonce_hex);
        $email_enc = xor_encrypt_hex($email, $this->secretKey, $nonce_hex);


        $this->model->update($id, [
            'name_enc' => $name_enc,
            'email_enc' => $email_enc,
            'nonce_hex' => $nonce_hex,
        ]);


        return redirect()->to('/contacts');
    }
    public function delete($id = null)
    {
        $this->model->delete($id);
        return redirect()->to('/contacts');
    }
}
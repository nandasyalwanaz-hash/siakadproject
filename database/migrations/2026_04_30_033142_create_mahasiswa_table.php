<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
/**
* Run the migrations.
*/
public function up(): void
{
Schema::create('mahasiswa', function (Blueprint $table) {
    $table->id();// PK 

    //auto increment=nilainya otomatis bertambah setiap kali ada data baru yang ditambahkan, 
    //sehingga kita tidak perlu mengisi secara manual.

    $table->string('nim');
    $table->string('nama');
    $table->string('tempat_lahir');
    $table->date('tanggal_lahir');
    $table->enum('jenis_kelamin', ['L', 'P']);
    $table->text('alamat');
    $table->string('agama');
    $table->string('no_hp');
    $table->string('email');
    $table->string('prodi');
    $table->string('fakultas');
    $table->integer('semester');           
    $table->string('asal_sekolah');
    $table->string('nama_ayah');
    $table->string('nama_ibu');
    $table->string('pekerjaan_ortu'); //16 field

    $table->timestamps(); //created_at dan updated_at = mencatat waktu data dibuat dan terakhir diperbarui
});
}
/**
* Reverse the migrations.
*/
public function down(): void
{
Schema::dropIfExists('mahasiswas');
}
};
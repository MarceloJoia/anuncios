<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        try {

            $this->db->transStart();

            foreach (self::categories() as $category) {

                $this->db->table('categories')->insert($category);
            }

            $this->db->transComplete();

            echo 'Categorias criadas com sucesso!';
        } catch (\Throwable $th) {

            log_message('error', '[ERROR] {exception}', ['exception' => $th]);

            print $th;
        }
    }


    private static function categories(): array
    {

        return [
            [
                "name" => "Esportes e Fitness",
                "slug" => "esportes-e-fitness",
                "parent_id" => null,
            ],
            [
                "name" => "Futebol",
                "slug" => "futebol",
                "parent_id" => 1,
            ],
            [
                "name" => "Futebol de Campo",
                "slug" => "futebol-de-campo",
                "parent_id" => 2,
            ],
            [
                "name" => "Acessórios para Veículos",
                "slug" => "acessorios-para-veiculos",
                "parent_id" => null,
            ],
            [
                "name" => "Som Automotivo",
                "slug" => "som-automotivo",
                "parent_id" => 4,
            ],
            [
                "name" => "Limpeza Automotiva",
                "slug" => "limpeza-automotiva",
                "parent_id" => 4,
            ],
            [
                "name" => "Ferramentas Automotivas",
                "slug" => "ferramentas-automotivas",
                "parent_id" => 4,
            ],
            [
                "name" => "Celulares e Telefones",
                "slug" => "celulares-e-telefones",
                "parent_id" => null,
            ],
            [
                "name" => "Acessórios para Celulares",
                "slug" => "acessorios-para-celulares",
                "parent_id" => 8,
            ],
            [
                "name" => "Peças para Celular",
                "slug" => "pecas-para-celular",
                "parent_id" => 8,
            ],
            [
                "name" => "Eletrodomésticos",
                "slug" => "eletrodomesticos",
                "parent_id" => null,
            ],
            [
                "name" => "Fornos e Fogões",
                "slug" => "fornos-e-fogoes",
                "parent_id" => 11,
            ],
            [
                "name" => "Eletrônicos, Áudio e Vídeo",
                "slug" => "eletronicos-audio-e-video",
                "parent_id" => null,
            ],
            [
                "name" => "Acessórios para Áudio e Vídeo",
                "slug" => "acessorios-para-audio-e-video",
                "parent_id" => 13,
            ],
            [
                "name" => "Acessórios para TV",
                "slug" => "acessorios-para-tv",
                "parent_id" => 13,
            ],
            [
                "name" => "Ferramentas",
                "slug" => "ferramentas",
                "parent_id" => null,
            ],
            [
                "name" => "Ferramentas Industriais",
                "slug" => "ferramentas-industriais",
                "parent_id" => null,
            ],
            [
                "name" => "Games",
                "slug" => "games",
                "parent_id" => null,
            ],
            [
                "name" => "Acessórios para Consoles",
                "slug" => "acessorios-para-consoles",
                "parent_id" => 18,
            ],
            [
                "name" => "Acessórios para PC Gaming",
                "slug" => "acessorios-para-pc-gaming",
                "parent_id" => 18,
            ],
            [
                "name" => "Consoles",
                "slug" => "consoles",
                "parent_id" => 18,
            ],
            [
                "name" => "Fliperama e Arcade",
                "slug" => "fliperama-e-arcade",
                "parent_id" => 18,
            ],
            [
                "name" => "Peças para Consoles",
                "slug" => "pecas-para-consoles",
                "parent_id" => 18,
            ],
            [
                "name" => "Video Games",
                "slug" => "video-games",
                "parent_id" => 18,
            ],
            [
                "name" => "Imóveis",
                "slug" => "imoveis",
                "parent_id" => null,
            ],
            [
                "name" => "Apartamentos",
                "slug" => "apartamentos",
                "parent_id" => 25,
            ],
            [
                "name" => "Casas",
                "slug" => "casas",
                "parent_id" => 25,
            ],
            [
                "name" => "Chácaras",
                "slug" => "chacaras",
                "parent_id" => 25,
            ],
            [
                "name" => "Fazendas",
                "slug" => "fazendas",
                "parent_id" => 25,
            ],
            [
                "name" => "Lojas Comerciais",
                "slug" => "lojas-comerciais",
                "parent_id" => 25,
            ],
            [
                "name" => "Terrenos",
                "slug" => "terrenos",
                "parent_id" => 25,
            ],
            [
                "name" => "Informática",
                "slug" => "informatica",
                "parent_id" => null,
            ],
            [
                "name" => "Armazenamento",
                "slug" => "armazenamento",
                "parent_id" => 32,
            ],
            [
                "name" => "Componentes para PC",
                "slug" => "componentes-para-pc",
                "parent_id" => 32,
            ],
            [
                "name" => "Conectividade e Redes",
                "slug" => "conectividade-e-redes",
                "parent_id" => 32,
            ],
            [
                "name" => "Impressão",
                "slug" => "impressao",
                "parent_id" => 32,
            ],
            [
                "name" => "Leitores e Scanners",
                "slug" => "leitores-e-scanners",
                "parent_id" => 32,
            ],
            [
                "name" => "Monitores e Acessórios",
                "slug" => "monitores-e-acessorios",
                "parent_id" => 32,
            ],
            [
                "name" => "Instrumentos Musicais",
                "slug" => "instrumentos-musicais",
                "parent_id" => null,
            ],
            [
                "name" => "Baterias e Percussão",
                "slug" => "baterias-e-percussao",
                "parent_id" => 39,
            ],
            [
                "name" => "Caixas de Som",
                "slug" => "caixas-de-som",
                "parent_id" => 39,
            ],
            [
                "name" => "Estúdio de Gravação",
                "slug" => "estudio-de-gravacao",
                "parent_id" => 39,
            ],
            [
                "name" => "Instrumentos de Corda",
                "slug" => "instrumentos-de-corda",
                "parent_id" => 39,
            ],
            [
                "name" => "Instrumentos de Sopro",
                "slug" => "instrumentos-de-sopro",
                "parent_id" => 39,
            ],
            [
                "name" => "Joias e Relógios",
                "slug" => "joias-e-relogios",
                "parent_id" => null,
            ],
            [
                "name" => "Acessórios para Relógios",
                "slug" => "acessorios-para-relogios",
                "parent_id" => 45,
            ],
            [
                "name" => "Joias e Bijuterias",
                "slug" => "joias-e-bijuterias",
                "parent_id" => 45,
            ],
            [
                "name" => "Relógios",
                "slug" => "relogios",
                "parent_id" => 45,
            ],
            [
                "name" => "Porta Joias",
                "slug" => "porta-joias",
                "parent_id" => 45,
            ],
            [
                "name" => "Serviços",
                "slug" => "servicos",
                "parent_id" => null,
            ],
            [
                "name" => "Academias",
                "slug" => "academias",
                "parent_id" => 50,
            ],
            [
                "name" => "Animais",
                "slug" => "animais",
                "parent_id" => 50,
            ],
            [
                "name" => "Festas e Eventos",
                "slug" => "festas-e-eventos",
                "parent_id" => 50,
            ],
            [
                "name" => "Marketing e Internet",
                "slug" => "marketing-e-internet",
                "parent_id" => 50,
            ],
            [
                "name" => "Suporte Técnico",
                "slug" => "suporte-tecnico",
                "parent_id" => 50,
            ],
        ];
    }
}

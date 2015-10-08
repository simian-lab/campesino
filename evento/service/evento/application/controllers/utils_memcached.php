<?php

class utils_memcached extends CI_Controller
{
    function paginacion($key_memcached = '')
    {
        $this->load->library('memcached_library');
        //$key_memcached='CollectorPromo_lista_promos';

        //   $this->memcached_library->delete($key_memcached);

        $results = $this->memcached_library->get($key_memcached);
        echo('key: ' . $key_memcached);
        echo('<pre>');
        print_r($results);
        echo('<pre>');
    }

    function testlistablanca()
    {
        $this->load->library('memcached_library');
        $key_memcached = 'lista_blanca_dominio';
        //   $this->memcached_library->delete($key_memcached);

        $results = $this->memcached_library->get($key_memcached);
        echo('key: ' . $key_memcached);
        echo('<pre>');
        print_r($results);
        echo('<pre>');
    }

    function test()
    {
        $this->output->enable_profiler(TRUE);
        // Load library
        $this->load->library('memcached_library');

        // Lets try to get the key
        $results = $this->memcached_library->get('test');

        // If the key does not exist it could mean the key was never set or expired
        if (!$results) {
            // Modify this Query to your liking!
            $query = date('l jS \of F Y h:i:s A');;

            // Lets store the results
            $this->memcached_library->add('test', $query);

            // Output a basic msg
            echo "Alright! Stored some results from the Query... Refresh Your Browser";
            var_dump($query);
        } else {
            // Output
            var_dump($results);

            // Now let us delete the key for demonstration sake!
            //	$this->memcached_library->delete('test');
        }
    }

    function delete()
    {
        $this->load->library('memcached_library');
        $this->memcached_library->flush();
    }

    function stats()
    {
        $this->load->library('memcached_library');

        echo('<pre>');
        print_r($this->memcached_library->getversion());
        echo('<pre>');
        echo "<br/>";

        // We can use any of the following "reset, malloc, maps, cachedump, slabs, items, sizes"
        $p = $this->memcached_library->getstats("sizes");
        echo('<pre>');
        print_r($p);
        echo('<pre>');
    }
}
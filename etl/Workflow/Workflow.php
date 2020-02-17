<?php

namespace Etl\Workflow;

use Etl\Extractor\Extractor;
use Etl\Loader\Loader;
use Etl\Storage\ExternalStorageInterface;
use Etl\Storage\WritableStorageInterface;
use Etl\Storage\InternalStorageInterface;
use Etl\Transformer\Transformer;

abstract class Workflow implements WorkflowInterface
{

    /**
     * every WF has it's own main internal storage of specific type
     * (implements Etl\Storage\InternalStorageInterface)
     * this type remains the same for the whole WF runtime
     * @var InternalStorageInterface $storage
     */
    private $storage;

    /**
     * @var Extractor[]
     */
    private $extractors;

    /**
     * @var Transformer[] $transformers
     */
    private $transformers;

    /**
     * @var Loader[] $loaders
     */
    private $loaders;

    /**
     * Workflow constructor.
     *
     * @param InternalStorageInterface $is
     * @param Extractor[] $extractors
     * @param Transformer[] $transformers
     * @param Loader[] $loaders
     */
    public function __construct(InternalStorageInterface $is, $extractors = [], $transformers = [], $loaders = [])
    {
        $this->storage = $is;

        // initialized extractors, transformers, loaders
        $this->extractors   = $extractors;
        $this->transformers = $transformers;
        $this->loaders      = $loaders;

        // for extractor - create it with internal storage of the FL, pass the file path to it

        // check somewhere if we have no internal storage or it is not initialized
    }

    public static function getRegisteredServices()
    {
        $extractorServices   = self::registerExtractorServices();
        $transformerServices = self::registerTransformerServices();
        $loaderServices      = self::registerLoaderServices();

        return array_merge($extractorServices, $transformerServices, $loaderServices);
    }

    abstract protected static function registerExtractorServices();

    abstract protected static function registerTransformerServices();

    abstract protected static function registerLoaderServices();

    protected function extract(string $extractorName): self
    {

        // call extractor service with storages of this WF
        $this->getExtractor($extractorName)->extract();

        return $this;
    }

    protected function transform(string $transformerName, InternalStorageInterface ...$storages): self
    {

        // call transformer service with storages of this wf

        $this->getTransformer($transformerName)->transform($storages);

        return $this;
    }

    protected function load(string $loaderName, ExternalStorageInterface $storage = null): self
    {

        // call loader service with storages of this WF
        $this->getLoader($loaderName)->load($storage);

        return $this;
    }

    // returns WF storage storage clone
    protected function getStorageClone()
    {

        // return internal storage of the Workflow

        return $this->storage->getClone();
    }

    protected function then(\Closure $callback)
    {
        $callback->call($this);

        return $this;
    }

    private function getExtractor(string $name)
    {
        // check and
        // exception
        return $this->extractors[$name];
    }

    private function getTransformer(string $name)
    {
        // check and
        // exception
        return $this->transformers[$name];
    }

    private function getLoader(string $name)
    {
        // check and
        // exception
        return $this->loaders[$name];
    }

    private function initializeStorage() {
        $this->storage->create();
    }
}

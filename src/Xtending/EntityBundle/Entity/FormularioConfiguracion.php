<?php

namespace Xtending\EntityBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Xtending\EntityBundle\Entity\XtendingConstantes;

use Doctrine\ORM\Mapping as ORM;

/**
 * FormulariosDefiniciones
 */
class FormularioConfiguracion
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var FormulariosDefiniciones
     */
    private $formularioDefincion;
    


    /**
     * @var integer
     */
    private $filtroFechaDesdeHasta;
    

    
    /**
     * @var integer
     */
    private $filtroSite;
    

    
    /**
     * @var integer
     */
    private $filtroContacto;
    

    
    /**
     * @var integer
     */
    private $filtroAutor;
    


    /**
     * @var integer
     */
    private $filtroEmpresa;
   

    
    /**
     * @var integer
     */
    private $filtroCodigo;
    

    
    /**
     * @var integer
     */
    private $filtroEstado;
    

    
    /**
     * @var integer
     */
    private $filtroPais;
    

    
    /**
     * @var integer
     */
    private $listadoEstado;
    

    
    /**
     * @var integer
     */
    private $listadoCodigo;
    

    
    /**
     * @var integer
     */
    private $listadoNombre;
    

    
    /**
     * @var integer
     */
    private $listadoFechaManual;
    

    
    /**
     * @var integer
     */
    private $listadoSite;
    

    
    /**
     * @var integer
     */
    private $listadoFechaAutomatica;
    

    
    /**
     * @var integer
     */
    private $listadoContacto;
    


    /**
     * @var integer
     */
    private $listadoAutor;
    


    /**
     * @var integer
     */
    private $listadoEmpresa;
    
   
    
    /**
     * @var integer
     */
    private $listadoInformePdf;
    
    /**
     * @var integer
     */
    private $tieneDocTexto;
    
    /**
     * @var integer
     */
    private $tienePresentacion;
    
    /**
     * @var integer
     */
    private $tieneDatosTemplate;
    
    /**
     * @var integer
     */
    private $listadoInformeExcel;
    
    
    /**
     * @var string
     */
    private $datoTemplate;
    
    /**
     * @var string
     */
    private $presentacion;
    
    /**
     * @var string
     */
    private $docTexto;
    
    /**
     * @var file
     */
    private $fileDocTexto;
    
    /**
     * @var file
     */
    private $filePresentacion;
    
    /**
     * @var file
     */
    private $fileDatoTemplate;
    
    private $temp;
   
    
    
   
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function setListadoInformePdf($listadoInformePdf)
    {
    	$this->listadoInformePdf = $listadoInformePdf;
    
    	return $this;
    }
    
    
    public function getListadoInformePdf()
    {
    	return $this->listadoInformePdf;
    }
    
    
    public function setListadoInformeExcel($listadoInformeExcel)
    {
    	$this->listadoInformeExcel = $listadoInformeExcel;
    
    	return $this;
    }
    
    
    public function getListadoInformeExcel()
    {
    	return $this->listadoInformeExcel;
    }
    
    public function setListadoCodigo($listadoCodigo)
    {
    	$this->listadoCodigo = $listadoCodigo;
    
    	return $this;
    }
    
    
    public function setListadoEmpresa($listadoEmpresa)
    {
    	$this->listadoEmpresa = $listadoEmpresa;
    
    	return $this;
    }
    
    
    public function getListadoEmpresa()
    {
    	return $this->listadoEmpresa;
    }
    
    public function setListadoAutor($listadoAutor)
    {
    	$this->listadoAutor = $listadoAutor;
    
    	return $this;
    }
    
    
    public function getListadoAutor()
    {
    	return $this->listadoAutor;
    }
    
    public function setListadoContacto($listadoContacto)
    {
    	$this->listadoContacto = $listadoContacto;
    
    	return $this;
    }
    
    
    public function getListadoContacto()
    {
    	return $this->listadoContacto;
    }
    
    public function setListadoFechaAutomatica($listadoFechaAutomatica)
    {
    	$this->listadoFechaAutomatica = $listadoFechaAutomatica;
    
    	return $this;
    }
    
    
    public function getListadoFechaAutomatica()
    {
    	return $this->listadoFechaAutomatica;
    }
    
    public function getListadoCodigo()
    {
    	return $this->listadoCodigo;
    }
    
    public function setListadoSite($listadoSite)
    {
    	$this->listadoSite = $listadoSite;
    
    	return $this;
    }
    
    
    public function getListadoSite()
    {
    	return $this->listadoSite;
    }
    public function setListadoFechaManual($listadoFechaManual)
    {
    	$this->listadoFechaManual = $listadoFechaManual;
    
    	return $this;
    }
    
    
    public function getListadoFechaManual()
    {
    	return $this->listadoFechaManual;
    }
    
    public function setListadoNombre($listadoNombre)
    {
    	$this->listadoNombre = $listadoNombre;
    
    	return $this;
    }
    
    
    public function getListadoNombre()
    {
    	return $this->listadoNombre;
    }
    

    
    public function setListadoEstado($listadoEstado)
    {
    	$this->listadoEstado = $listadoEstado;
    
    	return $this;
    }
    
    
    public function getListadoEstado()
    {
    	return $this->listadoEstado;
    }
    
    public function setFiltroPais($filtroPais)
    {
    	$this->filtroPais = $filtroPais;
    
    	return $this;
    }
    
    
    public function getFiltroPais()
    {
    	return $this->filtroPais;
    }
    
    public function setFiltroEstado($filtroEstado)
    {
    	$this->filtroEstado = $filtroEstado;
    
    	return $this;
    }
    
    
    public function getFiltroEstado()
    {
    	return $this->filtroEstado;
    }
    
    public function setFiltroCodigo($filtroCodigo)
    {
    	$this->filtroCodigo = $filtroCodigo;
    
    	return $this;
    }
    
    
    public function getFiltroCodigo()
    {
    	return $this->filtroCodigo;
    }
    
    public function setFiltroEmpresa($filtroEmpresa)
    {
    	$this->filtroEmpresa = $filtroEmpresa;
    
    	return $this;
    }
    
    
    public function getFiltroEmpresa()
    {
    	return $this->filtroEmpresa;
    }
    
    public function setFiltroAutor($filtroAutor)
    {
    	$this->filtroAutor = $filtroAutor;
    
    	return $this;
    }
    
    
    public function getFiltroAutor()
    {
    	return $this->filtroAutor;
    }
    
    public function setFiltroContacto($filtroContacto)
    {
    	$this->filtroContacto = $filtroContacto;
    
    	return $this;
    }
    
    
    public function getFiltroContacto()
    {
    	return $this->filtroContacto;
    }
    
    public function setFiltroSite($filtroSite)
    {
    	$this->filtroSite = $filtroSite;
    
    	return $this;
    }
    
    
    public function getFiltroSite()
    {
    	return $this->filtroSite;
    }
    
    public function setFiltroFechaDesdeHasta($filtroFechaDesdeHasta)
    {
    	$this->filtroFechaDesdeHasta = $filtroFechaDesdeHasta;
    
    	return $this;
    }
    
    
    public function getFiltroFechaDesdeHasta()
    {
    	return $this->filtroFechaDesdeHasta;
    }
    
    public function setFormularioDefincion(FormulariosDefiniciones $formularioDefincion)
    {
    	$this->formularioDefincion = $formularioDefincion;
    
    	return $this;
    }
    
    
    public function getFormularioDefincion()
    {
    	return $this->formularioDefincion;
    }
    
    public function setTieneDatosTemplate($valor)
    {
    	$this->tieneDatosTemplate = $valor;
    
    	return $this;
    }
    
    
    public function getTieneDatosTemplate()
    {
    	return $this->tieneDatosTemplate;
    }
    
    public function setTienePresentacion($valor)
    {
    	$this->tienePresentacion = $valor;
    
    	return $this;
    }
    
    
    public function getTienePresentacion()
    {
    	return $this->tienePresentacion;
    }
    
    public function setTieneDocTexto($valor)
    {
    	$this->tieneDocTexto = $valor;
    
    	return $this;
    }
    
    
    public function getTieneDocTexto()
    {
    	return $this->tieneDocTexto;
    }
    
    /**
     * Set docTexto
     *
     * @param string $docTexto
     * @return FormularioConfiguracion
     */
    public function setDocTexto($docTexto)
    {
    	$this->docTexto = $docTexto;
    
    	return $this;
    }
    
    /**
     * Get docTexto
     *
     * @return string
     */
    public function getDocTexto()
    {
    	return $this->docTexto;
    }
    
    /**
     * Set presentacion
     *
     * @param string $presentacion
     * @return FormularioConfiguracion
     */
    public function setPresentacion($presentacion)
    {
    	$this->presentacion = $presentacion;
    
    	return $this;
    }
    
    /**
     * Get presentacion
     *
     * @return string
     */
    public function getPresentacion()
    {
    	return $this->presentacion;
    }
    
    /**
     * Set datoTemplate
     *
     * @param string $dato
     * @return FormularioConfiguracion
     */
    public function setDatoTemplate($dato)
    {
    	$this->datoTemplate = $dato;
    
    	return $this;
    }
    
    /**
     * Get datoTemplate
     *
     * @return string
     */
    public function getDatoTemplate()
    {
    	return $this->datoTemplate;
    }
    
    /**
     * Get filePresentacion.
     *
     * @return UploadedFile
     */
    public function getFilePresentacion()
    {
    	return $this->filePresentacion;
    }
    
    /**
     * Get fileDocTexto.
     *
     * @return UploadedFile
     */
    public function getFileDocTexto()
    {
    	return $this->fileDocTexto;
    }
    
    /**
     * Get fileDatoTemplate.
     *
     * @return UploadedFile
     */
    public function getFileDatoTemplate()
    {
    	return $this->fileDatoTemplate;
    }
    
    
    public function getAbsolutePathPresentacion()
    {
    	return null === $this->presentacion
    	? null
    	: $this->getUploadRootDir().$this->presentacion;
    }
    
    public function getAbsolutePathDocTexto()
    {
    	return null === $this->docTexto
    	? null
    	: $this->getUploadRootDir().$this->docTexto;
    }
    
    public function getAbsolutePathDatoTemplate()
    {
    	return null === $this->datoTemplate
    	? null
    	: $this->getUploadRootDir().$this->datoTemplate;
    }
    public function getWebPath()
    {
    	return null === $this->presentacion
    	? null
    	: $this->presentacion;
    }
    
    public function getWebPathDocTexto()
    {
    	return null === $this->docTexto
    	? null
    	: $this->docTexto;
    }
    
    public function getWebPathDatoTemplate()
    {
    	return null === $this->datoTemplate
    	? null
    	: $this->datoTemplate;
    }
    
    protected function getUploadRootDir()
    {
    	// la ruta absoluta del directorio donde se deben
    	// guardar los archivos cargados
    	return 'uploads/reporting/';
    }
    
    /**
     * Set filePresentacion.
     *
     * @param UploadedFile $file
     *
     */
    public function setFilePresentacion(UploadedFile $file = null)
    {
    	$this->filePresentacion = $file;
    	// check if we have an old image path
    	$extension = $this->getFilePresentacion()->guessExtension();
    	if (!$extension) {
    		// no se puede deducir la extensión
    		$extension = 'bin';
    	}
    
    	//     	$filename = rand(1,99999).'.'.$extension;
    	//     	$this->especificacion = $this->getUploadRootDir().$filename;
    	$filename = strval(date("Ymdhis")).'-'.XtendingConstantes::sanear_string($this->getFilePresentacion()->getClientOriginalName());
    	$this->presentacion = $filename;
    	$this->upload($this->filePresentacion, $this->presentacion);
    }
    
    /**
     * Set fileDocTexto.
     *
     * @param UploadedFile $file
     *
     */
    public function setFileDocTexto(UploadedFile $file = null)
    {
    	$this->fileDocTexto = $file;
    	// check if we have an old image path
    	$extension = $this->getFileDocTexto()->guessExtension();
    	if (!$extension) {
    		// no se puede deducir la extensión
    		$extension = 'bin';
    	}
    
    	//     	$filename = rand(1,99999).'.'.$extension;
    	//     	$this->imagen = $this->getUploadRootDir().$filename;
    	$filename = strval(date("Ymdhis")).'-'.XtendingConstantes::sanear_string($this->getFileDocTexto()->getClientOriginalName());
    	$this->docTexto = $filename;
    	$this->upload($this->fileDocTexto, $this->docTexto);
    }
    
    /**
     * Set fileDatoTemplate.
     *
     * @param UploadedFile $file
     *
     */
    public function setFileDatoTemplate(UploadedFile $file = null)
    {
    	$this->fileDatoTemplate = $file;
    	// check if we have an old image path
    	$extension = $this->getFileDatoTemplate()->guessExtension();
    	if (!$extension) {
    		// no se puede deducir la extensión
    		$extension = 'bin';
    	}
    
    	//     	$filename = rand(1,99999).'.'.$extension;
    	//     	$this->registro = $this->getUploadRootDir().$filename;
    	$filename = strval(date("Ymdhis")).'-'.XtendingConstantes::sanear_string($this->getFileDatoTemplate()->getClientOriginalName());
    	$this->datoTemplate = $filename;
    	$this->upload($this->fileDatoTemplate, $this->datoTemplate);
    }
    
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload($file, $ubicacion)
    {
    	if (null === $file) {
    		return;
    	}
    
    	// si hay un error al mover el archivo, move() automáticamente
    	// envía una excepción. This will properly prevent
    	// the entity from being persisted to the database on error
    	$file->move($this->getUploadRootDir(), $ubicacion);
    
    	// check if we have an old image
    	if (isset($this->temp)) {
    		// delete the old image
    		unlink($this->getUploadRootDir().'/'.$this->temp);
    		// clear the temp image path
    		$this->temp = null;
    	}
    	$file = null;
    }
     
    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
    	if ($file = $this->getAbsolutePath()) {
    		unlink($file);
    	}
    }

}
<?= $this->extend('headfoot'); ?>
<?= $this->section('content'); ?>

<script src="https://unpkg.com/react@18/umd/react.development.js"></script>
<script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>


<script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>

<section class="first-box">
  <div class="container">
    <div class="row">
      <div class="col">
        <div id="root"></div>
      </div>
    </div>
  </div>
</section>

<script type="text/babel">
  const container = document.getElementById('root');
  const root = ReactDOM.createRoot(container);

  function Text({pgf}) {
   return (<>
   <h1> Belajar React🐱‍🏍 </h1>
   <p>{pgf ? pgf : "Default"}</p></>    )
  };

  function Mapping(){
    const [likes, setLikes] = React.useState(0);
    function clickHandle(){
      setLikes(likes + 1);
    }
    let i = 1;
    const data = ['Michael', 'Willieson', 'React'];
    return (<> 
    <ul>
    {data.map((data) => (
    <li key={i++}>{data}</li>
    ))} </ul>
    <button className="btn btn-outline-primary" onClick={clickHandle}>👍 ({likes})</button>
    </>)
  };

  function Counter(){

    const [numbing, setNumbing] = React.useState(0);

    function handleCounter(action){
    if(action === 'increment'){
      if(numbing > 9){
          setNumbing('done!');
        }else{
          setNumbing(numbing + 1);
        }
    } else if(action === 'decrement'){
        if(numbing < 1){
          setNumbing('done!');
        }else{
          setNumbing(numbing - 1);
        }
      
    } else if(action === 'reset'){
      setNumbing(0);
    }
  }
    return(<>
    
    <h1>Creating Counter</h1>
    <div className="d-flex">
    <button onClick={() => handleCounter('decrement')}  disabled={numbing === 'done!'} className="m-3">-</button>
    <h4  className="m-3">{numbing}</h4>
    <button onClick={() => handleCounter('increment')}  disabled={numbing === 'done!'} className="m-3">+</button>
    </div>
    <button disabled={numbing !== 'done!'}  onClick={() => handleCounter('reset')}>Reset</button>
    </>)
  }


  root.render(<><Text pgf="buset" /><Mapping /> <Counter /></>);
</script>

<?= $this->endSection(); ?>
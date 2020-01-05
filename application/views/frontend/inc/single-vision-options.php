<section>
<span class="lens-options-show d-none">
    <div class="row mt-4">
            <div class="col-lg-6" >
            <div class="custom-files-choses">
                <label> Upload your Prescription <input type="file" name="prescriptionImg" id="prescriptionImg"></label> 
            </div>
        </div>
        <div class="col-lg-6">
            <div class="custom-files-choses" onclick="document.querySelector('.prescrip').style.display='block';" >
                <label> Enter your Prescription<input type="checkbox" name="prescriptionEnter"></label> 
            </div>
        </div>
    </div>
</span>

<div class="table-wrap table-responsive prescrip" >
    <!-- prescription -->

    <table class="table-inner w-100">
        <thead>
            <tr>
                <th></th>
                <th><span>SPHERE (SPH)</span></th>
                <th><span>cylinder (CYL)</span></th>
                <th><span>AXIS</span></th>
                <th class="progressive-vision-visible"><span>ADD</span></th>
            </tr>
        </thead>
        <tbody class="add-hide" id="prescription-table">
            <tr>
                <td>Right Eye</td>
                <td>
                   <select class="form-control" value="0" name="rsph" id="rsph" placeholder="SPH">
                    <option value="">Select Power</option>
                       <?php
                        $sph = $cyl = $add = '';
                        for ($i= - 8.00; $i <= 8.00; $i += 0.25) {
                            $j = number_format((float)$i, 2, '.', '');
                            $j = ($j > 0)? '+'.$j:$j;
                            $opt = '<option value="'.$j.'">'.$j.'</option>';
                            $sph .= $opt;
                            if($i>= -6 && $i <= 6)
                                $cyl .= $opt;
                            if($i>= 1 && $i <= 3.5)
                                $add .= $opt;
                        }
                       ?>
                       <?=$sph?>
                   </select> 
                </td>
                <td>
                    <select class="form-control" value="0" name="rcyl" id="rcyl" placeholder="CYL">
                    <option value="">Select Power</option>
                       <?=$cyl?>
                   </select> 
                </td>
                <td>
                   <input type="number" class="form-control" value="0" name="raxis" placeholder="AXIS">
                </td>
                <td class="progressive-vision-visible">
                    <select class="form-control" value="0" name="radd" id="radd" placeholder="Add">
                    <option value="">Add</option>
                       <?=$add?>
                   </select> 
                </td>
            </tr>
            <!-- left   -->
            <tr>
                <td>Left Eye</td>
                <td>
                    <select class="form-control" value="0" name="lsph" id="lsph" placeholder="SPH">
                        <option value="">Select Power</option> 
                        <?=$sph?>
                   </select> 
                </td>
                <td>
                    <select class="form-control" value="0" name="lcyl" id="lcyl" placeholder="CYL">
                        <option value="">Select Power</option>
                        <?=$cyl?>
                   </select> 
                </td>
                <td>
                  <input type="number" class="form-control" value="0" name="laxis" placeholder="AXIS">
                </td>
                <td class="progressive-vision-visible">
                    <select class="form-control" value="0" name="ladd" id="ladd" placeholder="Add">
                    <option value="">Add</option>
                       <?=$add?>
                   </select> 
                </td>
            </tr>
            <tr class="pd-box hide" >
				<td>PD</td>
				<td class="pd">
					<select name="pd" id="pd">
						<option value="" selected="selected">PD</option>
						
							<option value="54">54</option>
						
							<option value="55">55</option>
						
							<option value="56">56</option>
						
							<option value="57">57</option>
						
							<option value="58">58</option>
						
							<option value="59">59</option>
						
							<option value="60">60</option>
						
							<option value="61">61</option>
						
							<option value="62">62</option>
						
							<option value="63">63</option>
						
							<option value="64">64</option>
						
							<option value="65">65</option>
						
							<option value="66">66</option>
						
							<option value="67">67</option>
						
							<option value="68">68</option>
						
							<option value="69">69</option>
						
							<option value="70">70</option>
						
							<option value="71">71</option>
						
							<option value="72">72</option>
						
							<option value="73">73</option>
						
							<option value="74">74</option>
						
							<option value="75">75</option>
						
							<option value="76">76</option>
						
							<option value="77">77</option>
						
							<option value="78">78</option>
						
					</select>
				</td>
			</tr>
            <tr>
                <td>Additional Information</td>
                <td colspapn="3" class="w-100 ">
                    <textarea name="additionalInfo" class="form-control w-100" id="" cols="20"  ></textarea>
                </td>
               
            </tr>
        </tbody>
    </table>
    <!-- prescription -->

</div>
</section>

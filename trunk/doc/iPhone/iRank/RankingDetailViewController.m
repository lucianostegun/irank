    //
//  RankingDetailViewController.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import "RankingDetailViewController.h"
#import "EditableTableViewCell.h"
#import "iRankAppDelegate.h"

@implementation RankingDetailViewController
@synthesize ranking;
@synthesize pickerView;
@synthesize pickerOptionList;

- (id)initWithStyle:(UITableViewStyle)style
{
    self = [super initWithStyle:style];
    if (self) {
        // Custom initialization
    }
    return self;
}

- (void)didReceiveMemoryWarning
{
    // Releases the view if it doesn't have a superview.
    [super didReceiveMemoryWarning];
    
    // Release any cached data, images, etc that aren't in use.
}

#pragma mark - View lifecycle

- (void)viewDidLoad
{
    [super viewDidLoad];
    
    pickerOptionList = [[NSMutableArray alloc] init];
    
    NSMutableArray *gameStyleList = [[NSMutableArray alloc] init];
    [gameStyleList addObject:@"Torneio"];
    [gameStyleList addObject:@"Ring game"];
    [gameStyleList addObject:@"Sit & Go"];
    
    NSMutableArray *rankingTypeList = [[NSMutableArray alloc] init];
    [rankingTypeList addObject:@"Balanço"];
    [rankingTypeList addObject:@"Ganhos"];
    [rankingTypeList addObject:@"Média"];
    [rankingTypeList addObject:@"Pontos"];
    
    NSMutableArray *isPrivateList = [[NSMutableArray alloc] init];
    [isPrivateList addObject:@"Público"];
    [isPrivateList addObject:@"Privado"];
    
    [pickerOptionList addObject:gameStyleList];
    [pickerOptionList addObject:isPrivateList];
    [pickerOptionList addObject:rankingTypeList];
    
    self.navigationItem.rightBarButtonItem = saveButton;
}

- (void)viewDidUnload
{
    [super viewDidUnload];
    // Release any retained subviews of the main view.
    // e.g. self.myOutlet = nil;
}

- (void)viewWillAppear:(BOOL)animated
{
    [super viewWillAppear:animated];
    
    [self.tableView reloadData];    
    [[NSNotificationCenter defaultCenter] 
     addObserver:self 
     selector:@selector(keyboardWillAppear:) 
     name:UIKeyboardWillShowNotification 
     object:nil];
}

- (void)viewDidAppear:(BOOL)animated
{
    [super viewDidAppear:animated];
}

- (void)viewWillDisappear:(BOOL)animated
{
    [super viewWillDisappear:animated];
}

- (void)viewDidDisappear:(BOOL)animated
{
    [super viewDidDisappear:animated];
}

- (BOOL)shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)interfaceOrientation
{
    // Return YES for supported orientations
    return (interfaceOrientation == UIInterfaceOrientationPortrait);
}

#pragma mark - Table view data source

- (NSInteger)numberOfSectionsInTableView:(UITableView *)tableView
{
    
    return 2;
}

- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section
{
    
    int rows = 0;
    switch( section ){
        case 0:
            rows = 7;
            break;
        case 1:
            rows = 4;
            break;
        default:
            break;
    }
    
    return rows;
}

- (UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath
{
    NSString *CellIdentifier = [NSString stringWithFormat:@"CellSection%i", indexPath.section];
    
    EditableTableViewCell *cell = [tableView dequeueReusableCellWithIdentifier:CellIdentifier];
    
    if (cell == nil) {
        if( indexPath.section==0 )
            cell = [[[EditableTableViewCell alloc] initWithStyle:UITableViewCellStyleDefault reuseIdentifier:CellIdentifier] autorelease];
        else
            cell = [[[UITableViewCell alloc] initWithStyle:UITableViewCellStyleDefault reuseIdentifier:CellIdentifier] autorelease];
    }
    
    if( indexPath.section==0 ){
        
        cell.detailTextLabel.font = [UIFont systemFontOfSize:15];
        
        switch (indexPath.row) {
            case 0:
                cell.leftLabel.text = @"Nome";
                cell.rightTextField.text = [ranking.rankingName stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
                cell.rightTextField.delegate = self;
                cell.rightTextField.placeholder = @"Informe o nome do ranking";
                cell.selectionStyle = UITableViewCellEditingStyleNone;
                cell.rightTextField.tag = 0;
                break;
            case 1:
                cell.leftLabel.text = @"Estilo";
                cell.rightTextField.text = [ranking.gameStyle stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
                cell.rightTextField.enabled = NO;
                cell.rightTextField.tag = 1;
                break;
            case 2:
                cell.leftLabel.text = @"Inicio";
                cell.rightTextField.text = [ranking.startDate stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
                cell.rightTextField.placeholder = @"Data de início";
                cell.rightTextField.enabled = NO;
                cell.rightTextField.tag = 2;
                break;
            case 3:
                cell.leftLabel.text = @"Término";
                cell.rightTextField.text = [ranking.finishDate stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
                cell.rightTextField.placeholder = @"Data de término";
                cell.rightTextField.enabled = NO;
                cell.rightTextField.tag = 3;
                break;
            case 4:
                cell.leftLabel.text = @"Exibição";
                cell.rightTextField.text = ([ranking.isPrivate isEqualToString:@"1"]?@"Privado":@"Público");
                cell.rightTextField.enabled = NO;
                cell.rightTextField.tag = 4;
                break;
            case 5:
                cell.leftLabel.text = @"Classificação";
                cell.rightTextField.text = [ranking.rankingType stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
                cell.rightTextField.enabled = NO;
                cell.rightTextField.tag = 5;
                break;
            case 6:
                cell.leftLabel.text = @"Buy-in padrão";
                cell.rightTextField.text = [ranking.defaultBuyin stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
                cell.rightTextField.delegate = self;
                cell.rightTextField.placeholder = @"Valor padrão do buy-in";
                cell.selectionStyle = UITableViewCellEditingStyleNone;
                cell.rightTextField.tag = 6;
                break;
            default:
                break;
        }
    }else{
        
        switch (indexPath.row) {
            case 0:
                cell.textLabel.text = @"Jogadores";
                break;
            case 1:
                cell.textLabel.text = @"Eventos";
                break;
            case 2:
                cell.textLabel.text = @"Classificação";
                break;
            case 3:
                cell.textLabel.text = @"Opções";
                break;
            default:
                break;
        }
        
        cell.accessoryType = UITableViewCellAccessoryDisclosureIndicator;
    }
    
    return cell;
}

- (NSString *)tableView:(UITableView *)tableView 
titleForHeaderInSection:(NSInteger)section {
    
    NSString *title = nil;
    
    switch (section) {
        case 0:
            title = @"Informações principais";
            break;
        case 1:
            title = @"Informações adicionais";
            break;
            break;
        default:
            break;
    }
    
    return title;
}

/*
 // Override to support conditional editing of the table view.
 - (BOOL)tableView:(UITableView *)tableView canEditRowAtIndexPath:(NSIndexPath *)indexPath
 {
 // Return NO if you do not want the specified item to be editable.
 return YES;
 }
 */

/*
 // Override to support editing the table view.
 - (void)tableView:(UITableView *)tableView commitEditingStyle:(UITableViewCellEditingStyle)editingStyle forRowAtIndexPath:(NSIndexPath *)indexPath
 {
 if (editingStyle == UITableViewCellEditingStyleDelete) {
 // Delete the row from the data source
 [tableView deleteRowsAtIndexPaths:[NSArray arrayWithObject:indexPath] withRowAnimation:UITableViewRowAnimationFade];
 }   
 else if (editingStyle == UITableViewCellEditingStyleInsert) {
 // Create a new instance of the appropriate class, insert it into the array, and add a new row to the table view
 }   
 }
 */

/*
 // Override to support rearranging the table view.
 - (void)tableView:(UITableView *)tableView moveRowAtIndexPath:(NSIndexPath *)fromIndexPath toIndexPath:(NSIndexPath *)toIndexPath
 {
 }
 */

/*
 // Override to support conditional rearranging of the table view.
 - (BOOL)tableView:(UITableView *)tableView canMoveRowAtIndexPath:(NSIndexPath *)indexPath
 {
 // Return NO if you do not want the item to be re-orderable.
 return YES;
 }
 */

#pragma mark - Table view delegate

- (void)dismissDatePicker:(id)sender {
    
    if( datePicker.isHidden )
        return;
    
    self.navigationItem.leftBarButtonItem = nil;
    self.navigationItem.rightBarButtonItem = saveButton;
    
    CGRect datePickerTargetFrame = CGRectMake(0, self.view.bounds.size.height+44, 320, 216);
    [UIView beginAnimations:@"MoveOut" context:nil];
    datePicker.frame = datePickerTargetFrame;
    [UIView setAnimationDelegate:self];
    [UIView setAnimationDidStopSelector:@selector(removeDatePickerViews:)];
    [UIView commitAnimations];
    
    self.navigationItem.hidesBackButton = NO;
    
}

- (void)changeDate:(id)sender {
    
    NSIndexPath *indexPath = [self.tableView indexPathForSelectedRow];
    EditableTableViewCell *cell = (EditableTableViewCell*)[self.tableView cellForRowAtIndexPath:indexPath];
    
    NSDateFormatter *dateFormatter = [[[NSDateFormatter alloc] init] autorelease];
    [dateFormatter setDateFormat:@"dd/MM/yyyy"];
    
    switch (indexPath.row) {
        case 2:
            ranking.startDate = [dateFormatter stringFromDate:datePicker.date];
            break;
        case 3:
            ranking.finishDate = [dateFormatter stringFromDate:datePicker.date];
            break;
            
        default:
            break;
    }
    
    cell.rightTextField.text = [dateFormatter stringFromDate:datePicker.date];
    
    [self dismissDatePicker:datePicker];
}


- (void)removeDatePickerViews:(id)object {
    
    [datePicker removeFromSuperview];
    datePicker.hidden = YES;
}

- (void)tableView:(UITableView *)tableView didSelectRowAtIndexPath:(NSIndexPath *)indexPath
{
    
    if( indexPath.section==0 ){
        
        switch (indexPath.row) {
            case 2:
            case 3:
                [self dismissPickerView:pickerView];
                [self showDatePicker:indexPath];       
                break;
            case 1:
            case 4:
            case 5:
                [self dismissDatePicker:datePicker];
                [self showPickerView:indexPath];
                break;
            default:
                [self dismissDatePicker:datePicker];
                [self dismissPickerView:pickerView];
                break;
        }
    }else{
        
        [self dismissDatePicker:datePicker];
        [self dismissPickerView:pickerView];
    }
}








- (void)dismissPickerView:(id)sender {
    
    if( pickerView.isHidden )
        return;
    
    self.navigationItem.leftBarButtonItem = nil;
    self.navigationItem.rightBarButtonItem = saveButton;
    
    CGRect pickerViewTargetFrame = CGRectMake(0, self.view.bounds.size.height+44, 320, 216);
    [UIView beginAnimations:@"MoveOut" context:nil];
    pickerView.frame = pickerViewTargetFrame;
    [UIView setAnimationDelegate:self];
    [UIView setAnimationDidStopSelector:@selector(removePickerViewViews:)];
    [UIView commitAnimations];
    
    self.navigationItem.hidesBackButton = NO;
    
}

- (void)changePickerValue:(id)sender {
    
    [self dismissPickerView:pickerView];
}


- (void)removePickerViewViews:(id)object {
    
    [pickerView removeFromSuperview];
    pickerView.hidden = YES;
}




- (void)showPickerView:(NSIndexPath *)indexPath {
    
    [[self view] endEditing:YES];
    
    int row = indexPath.row;
    
    row = (row==1?0:(row==4?1:2));
    
    EditableTableViewCell *cell = (EditableTableViewCell*)[self.tableView cellForRowAtIndexPath:indexPath];
    NSString *cellValue = cell.rightTextField.text;
    
    pickerView.tag = row;
    [pickerView reloadAllComponents];
    
    if( !pickerView.isHidden ){
        
        int index = 0;
        for(NSString *optionValue in [pickerOptionList objectAtIndex:row]){

            if( [cellValue isEqualToString:optionValue] ){
                [self.pickerView selectRow:index inComponent:0 animated:YES];
                break;
            }
            
            index++;
        }
        return;
    }
    
    pickerView.hidden = NO;
    
    iRankAppDelegate *appDelegate = (iRankAppDelegate *)[[UIApplication sharedApplication] delegate];
    [appDelegate.window addSubview:pickerView];
    
    CGRect screenRect = [[UIScreen mainScreen] applicationFrame];
    CGSize pickerSize = [pickerView sizeThatFits:CGSizeZero];
    CGRect startRect = CGRectMake(0.0,
                                  screenRect.origin.y + screenRect.size.height,
                                  pickerSize.width, pickerSize.height);
    
    pickerView.frame = startRect;
    
    // compute the end frame
    CGRect pickerRect = CGRectMake(0.0,
                                   screenRect.origin.y + screenRect.size.height - pickerSize.height,
                                   pickerSize.width,
                                   pickerSize.height);
    
    // start the slide up animation
    [UIView beginAnimations:nil context:NULL];
    [UIView setAnimationDuration:0.3];
    
    // we need to perform some post operations after the animation is complete
    [UIView setAnimationDelegate:self];
    
    pickerView.frame = pickerRect;
    
    [UIView commitAnimations];

    int index = 0;
    for(NSString *optionValue in [pickerOptionList objectAtIndex:row]){

        if( [cellValue isEqualToString:optionValue] ){
            [self.pickerView selectRow:index inComponent:0 animated:YES];
            break;
        }
            
        index++;
    }
    
    UIBarButtonItem *doneButton   = [[UIBarButtonItem alloc] initWithBarButtonSystemItem:UIBarButtonSystemItemDone target:self action:@selector(changePickerValue:)];
    UIBarButtonItem *cancelButton = [[UIBarButtonItem alloc] initWithBarButtonSystemItem:UIBarButtonSystemItemCancel target:self action:@selector(dismissPickerView:)];
    
    self.navigationItem.hidesBackButton = YES;
    self.navigationItem.leftBarButtonItem  = cancelButton;
    self.navigationItem.rightBarButtonItem = doneButton;
    [doneButton release];
    [cancelButton release];
}







- (NSInteger)numberOfComponentsInPickerView:(UIPickerView *)pickerView {
    
    return 1;
}

- (void)pickerView:(UIPickerView *)thePickerView didSelectRow:(NSInteger)row inComponent:(NSInteger)component
{
    
    NSIndexPath *indexPath = [self.tableView indexPathForSelectedRow];
    EditableTableViewCell *cell = (EditableTableViewCell*)[self.tableView cellForRowAtIndexPath:indexPath];
    
    cell.rightTextField.text = [[pickerOptionList objectAtIndex:thePickerView.tag] objectAtIndex:row];
    
    NSString *pickerValue = [[pickerOptionList objectAtIndex:thePickerView.tag] objectAtIndex:row];
    
    switch (indexPath.row) {
        case 1:
            ranking.gameStyle = pickerValue;
            break;
        case 4:
            ranking.isPrivate = ([pickerValue isEqualToString:@"Privado"]?@"1":@"0");
            break;
        case 5:
            ranking.rankingType = pickerValue;
            break;
            
        default:
            break;
    }
    
    [pickerValue release];
}

- (NSInteger)pickerView:(UIPickerView *)thePickerView numberOfRowsInComponent:(NSInteger)component;
{
    return [[pickerOptionList objectAtIndex:thePickerView.tag] count];
}

- (NSString *)pickerView:(UIPickerView *)thePickerView titleForRow:(NSInteger)row forComponent:(NSInteger)component;
{
    NSLog(@"row: %i", row);
    return [[pickerOptionList objectAtIndex:thePickerView.tag] objectAtIndex:row];
}














- (void)showDatePicker:(NSIndexPath *)indexPath {
    
    [[self view] endEditing:YES];
    
    EditableTableViewCell *cell = (EditableTableViewCell*)[self.tableView cellForRowAtIndexPath:indexPath];
    
    NSDateFormatter *dateFormatter = [[[NSDateFormatter alloc] init] autorelease];
    [dateFormatter setDateFormat:@"dd/MM/yyyy"];
    
    if( !datePicker.isHidden ){
        
        if( ![cell.rightTextField.text isEqualToString:@""] )
            datePicker.date = [dateFormatter dateFromString:cell.rightTextField.text];
        return;
    }
    
    datePicker.hidden = NO;
    
    iRankAppDelegate *appDelegate = (iRankAppDelegate *)[[UIApplication sharedApplication] delegate];
    [appDelegate.window addSubview:datePicker];
    
    // size up the picker view to our screen and compute the start/end frame origin for our slide up animation
    //
    // compute the start frame
    CGRect screenRect = [[UIScreen mainScreen] applicationFrame];
    CGSize pickerSize = [datePicker sizeThatFits:CGSizeZero];
    CGRect startRect = CGRectMake(0.0,
                                  screenRect.origin.y + screenRect.size.height,
                                  pickerSize.width, pickerSize.height);
    
    datePicker.frame = startRect;
    
    // compute the end frame
    CGRect pickerRect = CGRectMake(0.0,
                                   screenRect.origin.y + screenRect.size.height - pickerSize.height,
                                   pickerSize.width,
                                   pickerSize.height);
    
    // start the slide up animation
    [UIView beginAnimations:nil context:NULL];
    [UIView setAnimationDuration:0.3];
    
    // we need to perform some post operations after the animation is complete
    [UIView setAnimationDelegate:self];
    
    datePicker.frame = pickerRect;
    
    [UIView commitAnimations];
    
    UIBarButtonItem *doneButton   = [[UIBarButtonItem alloc] initWithBarButtonSystemItem:UIBarButtonSystemItemDone target:self action:@selector(changeDate:)];
    UIBarButtonItem *cancelButton = [[UIBarButtonItem alloc] initWithBarButtonSystemItem:UIBarButtonSystemItemCancel target:self action:@selector(dismissDatePicker:)];
    
    self.navigationItem.hidesBackButton = YES;
    self.navigationItem.leftBarButtonItem  = cancelButton;
    self.navigationItem.rightBarButtonItem = doneButton;
    [doneButton release];
    [cancelButton release];

    if( ![cell.rightTextField.text isEqualToString:@""] )    
        datePicker.date = [dateFormatter dateFromString:cell.rightTextField.text];
}

-(BOOL)textFieldShouldReturn:(UITextField *)textField {
    
    switch (textField.tag) {
        case 0:
            ranking.rankingName = textField.text;
            break;
        case 6:
            ranking.defaultBuyin = textField.text;
            break;
        default:
            break;
    }
    
    [textField resignFirstResponder];
    
    return YES;
}

-(void)keyboardWillAppear:(NSNotification *)notification {
    
    [self dismissDatePicker:datePicker];
    [self dismissPickerView:pickerView];
}

-(void)saveRanking:(id)sender {
    
    [ranking save];
}

-(void)dealloc {
    
    [ranking release];
    [datePicker release];
    [pickerView release];
    [pickerOptionList release];
    [super dealloc];
}

@end
